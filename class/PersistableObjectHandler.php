<?php
//  ------------------------------------------------------------------------ //
//               COMMERCANTS PARTENAIRES - MODULE FOR XOOPS 2                //
//                  Copyright (c) 2005-2006 Instant Zero                     //
//                     <http://www.instant-zero.com/>                        //
// ------------------------------------------------------------------------- //
//  This program is NOT free software; you can NOT redistribute it and/or    //
//  modify without my assent.                                                //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed WITHOUT ANY WARRANTY; without even the       //
//  implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. //
//  ------------------------------------------------------------------------ //

defined('XOOPS_ROOT_PATH') || exit('XOOPS root path not defined');

class MjObject extends XoopsObject
{
    public function toArray($format = 's')
    {
        $ret = array();
        foreach ($this->vars as $k => $v) {
            $ret[$k] = $this->getVar($k, $format);
        }

        return $ret;
    }

    // TODO: Rajouter une méthode intsert() et delete()

    /**
     * Permet de valoriser un champ de la table comme si c'était une propriété de la classe
     *
     * @example $enregistrement->nom_du_champ = 'ma chaine'
     *
     * @param  string $key   Le nom du champ à traiter
     * @param  mixed  $value La valeur à lui attribuer
     */
    public function __set($key, $value)
    {
        return $this->setVar($key, $value);
    }

    /**
     * Permet d'accéder aux champs de la table comme à des propriétés de la classe
     *
     * @example echo $enregistrement->nom_du_champ;
     *
     * @param  string $key Le nom du champ que l'on souhaite récupérer
     * @return mixed
     */
    public function __get($key)
    {
        return $this->getVar($key);
    }
}

/**
 * Persistable Object Handler class.
 * This class is responsible for providing data access mechanisms to the data source
 * of derived class objects.
 *
 */
class MjXoopsPersistableObjectHandler extends XoopsObjectHandler
{
    /**#@+
     * Information about the class, the handler is managing
     *
     * @var string
     */
    public $table;
    public $keyName;
    public $className;
    public $identifierName;
    /**#@-*/

    /**
     * Constructor - called from child classes
     * @param object $db        {@link XoopsDatabase} object
     * @param string $tablename Name of database table
     * @param string $classname Name of Class, this handler is managing
     * @param string $keyname   Name of the property, holding the key
     *
     * @param bool   $idenfierName
     */
    public function __construct($db, $tablename, $classname, $keyname, $idenfierName = false)
    {
        parent::__construct($db);
        $this->table     = $db->prefix($tablename);
        $this->keyName   = $keyname;
        $this->className = $classname;
        if ($idenfierName != false) {
            $this->identifierName = $idenfierName;
        }
    }

    /**
     * create a new object
     *
     * @param bool $isNew Flag the new objects as "new"?
     *
     * @return XoopsObject
     */
    public function create($isNew = true)
    {
        $obj = new $this->className();
        if ($isNew === true) {
            $obj->setNew();
        }

        return $obj;
    }

    /**
     * retrieve an object
     *
     * @param  mixed $id        ID of the object - or array of ids for joint keys. Joint keys MUST be given in the same order as in the constructor
     * @param  bool  $as_object whether to return an object or an array
     * @return mixed reference to the object, FALSE if failed
     */
    public function &get($id, $as_object = true)
    {
        if (is_array($this->keyName)) {
            $criteria = new CriteriaCompo();
            $vnb      = count($this->keyName);
            for ($i = 0; $i < $vnb; ++$i) {
                $criteria->add(new Criteria($this->keyName[$i], (int)$id[$i], '='));
            }
        } else {
            $criteria = new Criteria($this->keyName, (int)$id, '=');
        }
        $criteria->setLimit(1);
        $obj_array = $this->getObjects($criteria, false, $as_object);
        if (count($obj_array) != 1) {
            $ret = null;
        } else {
            $ret =& $obj_array[0];
        }

        return $ret;
    }

    /**
     * retrieve objects from the database
     *
     * @param null|CriteriaElement $criteria  {@link CriteriaElement} conditions to be met
     * @param bool                 $id_as_key use the ID as key for the array?
     * @param bool                 $as_object return an array of objects?
     *
     * @return array
     */
    public function &getObjects(CriteriaElement $criteria = null, $id_as_key = false, $as_object = true)
    {
        $ret   = array();
        $limit = $start = 0;
        $sql   = 'SELECT * FROM ' . $this->table;
        if (isset($criteria) && is_subclass_of($criteria, 'criteriaelement')) {
            $sql .= ' ' . $criteria->renderWhere();
            if ($criteria->getSort() != '') {
                $sql .= ' ORDER BY ' . $criteria->getSort() . ' ' . $criteria->getOrder();
            }
            $limit = $criteria->getLimit();
            $start = $criteria->getStart();
        }
        $result = $this->db->query($sql, $limit, $start);
        if (!$result) {
            return $ret;
        }

        $ret = $this->convertResultSet($result, $id_as_key, $as_object);

        return $ret;
    }

    /**
     * Convert a database resultset to a returnable array
     *
     * @param object $result    database resultset
     * @param bool   $id_as_key - should NOT be used with joint keys
     * @param bool   $as_object
     *
     * @return array
     */
    public function convertResultSet($result, $id_as_key = false, $as_object = true)
    {
        $ret = array();
        while ($myrow = $this->db->fetchArray($result)) {
            $obj = $this->create(false);
            $obj->assignVars($myrow);
            if (!$id_as_key) {
                if ($as_object) {
                    $ret[] =& $obj;
                } else {
                    $row     = array();
                    $vars    = $obj->getVars();
                    $tbl_tmp = array_keys($vars);
                    foreach ($tbl_tmp as $i) {
                        $row[$i] = $obj->getVar($i);
                    }
                    $ret[] = $row;
                }
            } else {
                if ($as_object) {
                    $ret[$myrow[$this->keyName]] =& $obj;
                } else {
                    $row     = array();
                    $vars    = $obj->getVars();
                    $tbl_tmp = array_keys($vars);
                    foreach ($tbl_tmp as $i) {
                        $row[$i] = $obj->getVar($i);
                    }
                    $ret[$myrow[$this->keyName]] = $row;
                }
            }
            unset($obj);
        }

        return $ret;
    }

    /**
     * get IDs of objects matching a condition
     *
     * @param  CriteriaElement $criteria {@link CriteriaElement} to match
     * @return array  of object IDs
     */
    public function getIds(CriteriaElement $criteria = null)
    {
        $sql = 'SELECT ' . $this->keyName . ' FROM ' . $this->table;
        if (isset($criteria) && is_subclass_of($criteria, 'criteriaelement')) {
            $sql .= ' ' . $criteria->renderWhere();
        }
        $result = $this->db->query($sql);
        $ret    = array();
        while ($myrow = $this->db->fetchArray($result)) {
            $ret[] = $myrow[$this->keyName];
        }

        return $ret;
    }

    /**
     * Retrieve a list of objects as arrays - DON'T USE WITH JOINT KEYS
     *
     * @param CriteriaElement $criteria {@link CriteriaElement} conditions to be met
     * @param int             $limit    Max number of objects to fetch
     * @param int             $start    Which record to start at
     *
     * @return array
     */
    public function getList(CriteriaElement $criteria = null, $limit = 0, $start = 0)
    {
        $ret = array();
        if ($criteria == null) {
            $criteria = new CriteriaCompo();
        }

        if ($criteria->getSort() == '') {
            $criteria->setSort($this->identifierName);
        }

        $sql = 'SELECT ' . $this->keyName;
        if (!empty($this->identifierName)) {
            $sql .= ', ' . $this->identifierName;
        }
        $sql .= ' FROM ' . $this->table;
        if (isset($criteria) && is_subclass_of($criteria, 'criteriaelement')) {
            $sql .= ' ' . $criteria->renderWhere();
            if ($criteria->getSort() != '') {
                $sql .= ' ORDER BY ' . $criteria->getSort() . ' ' . $criteria->getOrder();
            }
            $limit = $criteria->getLimit();
            $start = $criteria->getStart();
        }
        $result = $this->db->query($sql, $limit, $start);
        if (!$result) {
            return $ret;
        }

        $myts = MyTextSanitizer::getInstance();
        while ($myrow = $this->db->fetchArray($result)) {
            //identifiers should be textboxes, so sanitize them like that
            $ret[$myrow[$this->keyName]] = empty($this->identifierName) ? 1 : $myts->htmlSpecialChars($myrow[$this->identifierName]);
        }

        return $ret;
    }

    /**
     * count objects matching a condition
     *
     * @param  CriteriaElement $criteria {@link CriteriaElement} to match
     * @return int    count of objects
     */
    public function getCount(CriteriaElement $criteria = null)
    {
        $field   = '';
        $groupby = false;
        if (isset($criteria) && is_subclass_of($criteria, 'criteriaelement')) {
            if ($criteria->groupby != '') {
                $groupby = true;
                $field   = $criteria->groupby . ', '; //Not entirely secure unless you KNOW that no criteria's groupby clause is going to be mis-used
            }
        }
        $sql = 'SELECT ' . $field . 'COUNT(*) FROM ' . $this->table;
        if (isset($criteria) && is_subclass_of($criteria, 'criteriaelement')) {
            $sql .= ' ' . $criteria->renderWhere();
            if ($criteria->groupby != '') {
                $sql .= $criteria->getGroupby();
            }
        }
        $result = $this->db->query($sql);
        if (!$result) {
            return 0;
        }
        if ($groupby == false) {
            list($count) = $this->db->fetchRow($result);

            return $count;
        } else {
            $ret = array();
            while (list($id, $count) = $this->db->fetchRow($result)) {
                $ret[$id] = $count;
            }

            return $ret;
        }
    }

    /**
     * delete an object from the database
     *
     * @param  XoopsObject $obj reference to the object to delete
     * @param  bool        $force
     * @return bool   FALSE if failed.
     */
    public function delete(XoopsObject $obj, $force = false)
    {
        if (is_array($this->keyName)) {
            $clause = array();
            $vnb    = count($this->keyName);
            for ($i = 0; $i < $vnb; ++$i) {
                $clause[] = $this->keyName[$i] . ' = ' . $obj->getVar($this->keyName[$i]);
            }
            $whereclause = implode(' AND ', $clause);
        } else {
            $whereclause = $this->keyName . ' = ' . $obj->getVar($this->keyName);
        }
        $sql = 'DELETE FROM ' . $this->table . ' WHERE ' . $whereclause;
        if (false != $force) {
            $result = $this->db->queryF($sql);
        } else {
            $result = $this->db->query($sql);
        }
        if (!$result) {
            return false;
        }

        return true;
    }

    /**
     * Quickly insert a record like this $myobject_handler->quickInsert('field1' => field1value, 'field2' => $field2value)
     *
     * @param  array $vars  Array containing the fields name and value
     * @param  bool  $force whether to force the query execution despite security settings
     * @return bool  @link insert's value
     */
    public function quickInsert($vars = null, $force = false)
    {
        $object = $this->create(true);
        $object->setVars($vars);
        $retval = $this->insert($object, $force);
        unset($object);

        return $retval;
    }

    /**
     * insert a new object in the database
     *
     * @param  XoopsObject $obj         reference to the object
     * @param  bool        $force       whether to force the query execution despite security settings
     * @param  bool        $checkObject check if the object is dirty and clean the attributes
     * @return bool   FALSE if failed, TRUE if already present and unchanged or successful
     */

    public function insert(XoopsObject $obj, $force = false, $checkObject = true)
    {
        if ($checkObject != false) {
            if (!is_object($obj)) {
                trigger_error('<br><h1>Error, not object</h1>');

                return false;
            }
            /**
             * @TODO: Change to if (!(class_exists($this->className) && $obj instanceof $this->className)) when going fully PHP5
             */
            if (!is_a($obj, $this->className)) {
                $obj->setErrors(get_class($obj) . ' Differs from ' . $this->className);

                return false;
            }
            if (!$obj->isDirty()) {
                $obj->setErrors('Not dirty'); //will usually not be outputted as errors are not displayed when the method returns true, but it can be helpful when troubleshooting code - Mith

                return true;
            }
        }
        if (!$obj->cleanVars()) {
            foreach ($obj->getErrors() as $oneerror) {
                trigger_error('<br><h2>' . $oneerror . '</h2>');
            }

            return false;
        }
        foreach ($obj->cleanVars as $k => $v) {
            if ($obj->vars[$k]['data_type'] == XOBJ_DTYPE_INT) {
                $cleanvars[$k] = (int)$v;
            } elseif (is_array($v)) {
                $cleanvars[$k] = $this->db->quoteString(implode(',', $v));
            } else {
                $cleanvars[$k] = $this->db->quoteString($v);
            }
        }
        if (isset($cleanvars['dohtml'])) {        // Modification Hervé to be able to use dohtml
            unset($cleanvars['dohtml']);
        }
        if ($obj->isNew()) {
            if (!is_array($this->keyName)) {
                if ($cleanvars[$this->keyName] < 1) {
                    $cleanvars[$this->keyName] = $this->db->genId($this->table . '_' . $this->keyName . '_seq');
                }
            }
            $sql = 'INSERT INTO ' . $this->table . ' (' . implode(',', array_keys($cleanvars)) . ') VALUES (' . implode(',', array_values($cleanvars)) . ')';
        } else {
            $sql = 'UPDATE ' . $this->table . ' SET';
            foreach ($cleanvars as $key => $value) {
                if ((!is_array($this->keyName) && $key == $this->keyName) || (is_array($this->keyName) && in_array($key, $this->keyName))) {
                    continue;
                }
                if (isset($notfirst)) {
                    $sql .= ',';
                }
                $sql .= ' ' . $key . ' = ' . $value;
                $notfirst = true;
            }
            if (is_array($this->keyName)) {
                $whereclause = '';
                $vnb         = count($this->keyName);
                for ($i = 0; $i < $vnb; ++$i) {
                    if ($i > 0) {
                        $whereclause .= ' AND ';
                    }
                    $whereclause .= $this->keyName[$i] . ' = ' . $obj->getVar($this->keyName[$i]);
                }
            } else {
                $whereclause = $this->keyName . ' = ' . $obj->getVar($this->keyName);
            }
            $sql .= ' WHERE ' . $whereclause;
        }
        if (false != $force) {
            $result = $this->db->queryF($sql);
        } else {
            $result = $this->db->query($sql);
        }
        if (!$result) {
            return false;
        }
        if ($obj->isNew() && !is_array($this->keyName)) {
            $obj->assignVar($this->keyName, $this->db->getInsertId());
        }

        return true;
    }

    /**
     * Change a value for objects with a certain criteria
     *
     * @param string $fieldname  Name of the field
     * @param string $fieldvalue Value to write
     * @param object $criteria   {@link CriteriaElement}
     *
     * @param bool   $force
     * @return bool
     */
    public function updateAll($fieldname, $fieldvalue, $criteria = null, $force = false)
    {
        $set_clause = $fieldname . ' = ';
        if (is_numeric($fieldvalue)) {
            $set_clause .= $fieldvalue;
        } elseif (is_array($fieldvalue)) {
            $set_clause .= $this->db->quoteString(implode(',', $fieldvalue));
        } else {
            $set_clause .= $this->db->quoteString($fieldvalue);
        }
        $sql = 'UPDATE ' . $this->table . ' SET ' . $set_clause;
        if (isset($criteria) && is_subclass_of($criteria, 'criteriaelement')) {
            $sql .= ' ' . $criteria->renderWhere();
        }
        if (false != $force) {
            $result = $this->db->queryF($sql);
        } else {
            $result = $this->db->query($sql);
        }
        if (!$result) {
            return false;
        }

        return true;
    }

    /**
     * delete all objects meeting the conditions
     *
     * @param  CriteriaElement $criteria {@link CriteriaElement} with conditions to meet
     * @return bool
     */

    public function deleteAll(CriteriaElement $criteria = null)
    {
        if (isset($criteria) && is_subclass_of($criteria, 'criteriaelement')) {
            $sql = 'DELETE FROM ' . $this->table;
            $sql .= ' ' . $criteria->renderWhere();
            if (!$this->db->queryF($sql)) {
                return false;
            }
            $rows = $this->db->getAffectedRows();

            return $rows > 0 ? $rows : true;
        }

        return false;
    }

    /**
     * Compare two objects and returns, in an array, the differences
     *
     * @param  XoopsObject $old_object The first object to compare
     * @param  XoopsObject $new_object The new object
     * @return array       differences  key = fieldname, value = array('old_value', 'new_value')
     */
    public function compareObjects($old_object, $new_object)
    {
        $ret       = array();
        $vars_name = array_keys($old_object->getVars());
        foreach ($vars_name as $one_var) {
            if ($old_object->getVar($one_var, 'f') == $new_object->getVar($one_var, 'f')) {
            } else {
                $ret[$one_var] = array($old_object->getVar($one_var), $new_object->getVar($one_var));
            }
        }

        return $ret;
    }
}
