<!-- Created by Instant Zero (http://www.instant-zero.com) -->
<br><br>
<div align="left"><a href="<{$xoops_url}>/modules/myjob/index.php"><{$smarty.const._MYJOB_INDEX}></a></div>
<br>
<{if $search_results}>
    <{if $help !=''}>
        <div style="text-align: left; margin: 10px;"><img src="<{$xoops_url}>/modules/myjob/assets/images/help.png" alt="" border="0" <{$help}> /></div><{/if}>
    <{if $pagenav !=''}>
        <div style="text-align: right; margin: 10px;"><{$pagenav}></div><{/if}>
    <table border="0" width="95%">
        <tr>
            <th align="center"><{$smarty.const._MYJOB_OFFER_DATEVALID}></th>
            <th align="center"><{$smarty.const._MYJOB_DEMAND_ZONEGEOGRAPHIQUE}></th>
            <th align="center"><{$smarty.const._MYJOB_DEMAND_SECTEURACTIVITE}></th>
            <th align="center"><{$smarty.const._MYJOB_DEMAND_DESCRIPTION}></th>
            <th align="center"><{$smarty.const._MYJOB_DEMAND_EXPERIENCE}></th>
            <th align="center"><{$smarty.const._MYJOB_DEMAND_TYPEPOSTE}></th>
        </tr>
        <{foreach item=onedemande from=$demandes}>
            <tr class="<{cycle values=" even,odd
    "}>" onclick="window.location='demande-view.php?demandid=<{$onedemande.demandid}>'">
                <td><{$onedemande.datevalidation|date_format:"%d/%m/%Y"}></td>
                <td><a href="<{$xoops_url}>/modules/myjob/demande-view.php?demandid=<{$onedemande.demandid}>"><{foreach item=onezone from=$onedemande.zonesidlibelle}><{$onezone}><br><{/foreach}></a></td>
                <td><{$onedemande.secteuridlibelle}></td>
                <td><a href="<{$xoops_url}>/modules/myjob/demande-view.php?demandid=<{$onedemande.demandid}>" <{$onedemande.tooltip}>><{$onedemande.titreannonce}></a></td>
                <td align="center"><{$onedemande.libelle_experience}></td>
                <td align="center"><{$typesoffres[$onedemande.typeposte]}></td>
            </tr>
        <{/foreach}>
    </table>
    <{if $help !=''}>
        <div style="text-align: left; margin: 10px;"><img src="<{$xoops_url}>/modules/myjob/assets/images/help.png" alt="" border="0" <{$help}> /></div><{/if}>
    <{if $pagenav !=''}>
        <div style="text-align: right; margin: 10px;"><{$pagenav}></div><{/if}>
    <br>
    <script language="JavaScript" type="text/javascript" src="<{$xoops_url}>/modules/myjob/js/wz_tooltip.js"></script>
<{/if}>
<{$search_form}>
