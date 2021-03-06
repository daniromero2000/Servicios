<!DOCTYPE html>
<html>

<head>

    <title>Push Email</title>
    <link rel="shortcut icon" href="favicon.ico">

    <style type="text/css">
        table[name="blk_permission"],
        table[name="blk_footer"] {
            display: none;
        }

    </style>

    <meta name="googlebot" content="noindex" />
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW" />
    <script type="text/javascript">
        function show_popup(popup_name, popup_url, popup_title, width, height) {
            var widthpx = width + "px";
            var heightpx = height + "px";
            emailwindow = dhtmlmodal.open(popup_name, 'iframe', popup_url, popup_title, 'width=' + widthpx +
                ',height=' + heightpx + ',center=1,resize=0,scrolling=1');
        }

        function show_modal(popup_name, popup_url, popup_title, width, height) {
            var widthpx = width + "px";
            var heightpx = height + "px";
            emailwindow = dhtmlmodal.open(popup_name, 'iframe', popup_url, popup_title, 'width=' + widthpx +
                ',height=' + heightpx + ',modal=1,center=1,resize=0,scrolling=1');
        }
        var popUpWin = 0;

        function popUpWindow(URLStr, PopUpName, width, height) {
            if (popUpWin) {
                if (!popUpWin.closed) popUpWin.close();
            }
            var left = (screen.width - width) / 2;
            var top = (screen.height - height) / 2;
            popUpWin = open(URLStr, PopUpName,
                'toolbar=0,location=0,directories=0,status=0,menub	ar=0,scrollbar=0,resizable=0,copyhistory=yes,width=' +
                width + ',height=' + height + ',left=' + left + ', 	top=' + top + ',screenX=' + left + ',screenY=' +
                top + '');
        }

    </script>

    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <style type="text/css">
        [name=bmeMainBody]{min-height:1000px}@media only screen and (max-width:480px){.bmeHolder,.bmeHolder1,table.blk,table.bmeMainColumn,table.tblText{width:100%!important}}@media only screen and (max-width:480px){.bmeImageCard table.bmeCaptionTable td.tblCell{padding:0 20px 20px 20px!important}}@media only screen and (max-width:480px){.bmeImageCard table.bmeCaptionTable.bmeCaptionTableMobileTop td.tblCell{padding:20px 20px 0 20px!important}}@media only screen and (max-width:480px){table.bmeCaptionTable td.tblCell{padding:10px!important}}@media only screen and (max-width:480px){table.tblGtr{padding-bottom:20px!important}}@media only screen and (max-width:480px){.blk_parent,.bmeBody,.bmeColumn1,.bmeColumn2,.bmeColumn3,.bmeLeftColumn,.bmeRightColumn,td.blk_container{display:table!important;max-width:600px!important;width:100%!important}}@media only screen and (max-width:480px){.bmeheadertext,.container-table,table.container-table{width:95%!important}}@media only screen and (max-width:480px){.mobile-footer,.mobile-footer a{font-size:13px!important;line-height:18px!important}.mobile-footer{text-align:center!important}table.share-tbl{padding-bottom:15px;width:100%!important}table.share-tbl td{display:block!important;text-align:center!important;width:100%!important}}@media only screen and (max-width:480px){td.bmeShareTD,td.bmeSocialTD{width:100%!important}}@media only screen and (max-width:480px){td.tdBoxedTextBorder{width:auto!important}}@media only screen and (max-width:480px){.bmeHolder,.bmeHolder1,table.blk,table[name=bmeMainColumn],table[name=tblText]{width:100%!important}}@media only screen and (max-width:480px){.bmeImageCard table.bmeCaptionTable td[name=tblCell]{padding:0 20px 20px 20px!important}}@media only screen and (max-width:480px){.bmeImageCard table.bmeCaptionTable.bmeCaptionTableMobileTop td[name=tblCell]{padding:20px 20px 0 20px!important}}@media only screen and (max-width:480px){table.bmeCaptionTable td[name=tblCell]{padding:10px!important}}@media only screen and (max-width:480px){table[name=tblGtr]{padding-bottom:20px!important}}@media only screen and (max-width:480px){.blk_parent,[name=bmeBody],[name=bmeColumn1],[name=bmeColumn2],[name=bmeColumn3],[name=bmeLeftColumn],[name=bmeRightColumn],td.blk_container{display:table!important;max-width:600px!important;width:100%!important}}@media only screen and (max-width:480px){.bmeheadertext,.container-table,table[class=container-table]{width:95%!important}}@media only screen and (max-width:480px){.mobile-footer,.mobile-footer a{font-size:13px!important;line-height:18px!important}.mobile-footer{text-align:center!important}table[class=share-tbl]{padding-bottom:15px;width:100%!important}table[class=share-tbl] td{display:block!important;text-align:center!important;width:100%!important}}@media only screen and (max-width:480px){td[name=bmeShareTD],td[name=bmeSocialTD]{width:100%!important}}@media only screen and (max-width:480px){td[name=tdBoxedTextBorder]{width:auto!important}}@media only screen and (max-width:480px){.bmeImageCard table.bmeImageTable{height:auto!important;width:100%!important;padding:20px!important;clear:both;float:left!important;border-collapse:separate}}@media only screen and (max-width:480px){.bmeMblInline table.bmeImageTable{height:auto!important;width:100%!important;padding:10px!important;clear:both}}@media only screen and (max-width:480px){.bmeMblInline table.bmeCaptionTable{width:100%!important;clear:both}}@media only screen and (max-width:480px){table.bmeImageTable{height:auto!important;width:100%!important;padding:10px!important;clear:both}}@media only screen and (max-width:480px){table.bmeCaptionTable{width:100%!important;clear:both}}@media only screen and (max-width:480px){table.bmeImageContainer{width:100%!important;clear:both;float:left!important}}@media only screen and (max-width:480px){table.bmeImageTable td{padding:0!important;height:auto}}@media only screen and (max-width:480px){td.bmeImageContainerRow{padding:0!important}}@media only screen and (max-width:480px){img.mobile-img-large{width:100%!important;height:auto!important}}@media only screen and (max-width:480px){img.bmeRSSImage{max-width:320px;height:auto!important}}@media only screen and (min-width:640px){img.bmeRSSImage{max-width:600px!important;height:auto!important}}@media only screen and (max-width:480px){.trMargin img{height:10px}}@media only screen and (max-width:480px){div.bmefooter,div.bmeheader{display:block!important}}@media only screen and (max-width:480px){.tdPart{width:100%!important;clear:both;float:left!important}}@media only screen and (max-width:480px){table.blk_parent1,table.tblPart{width:100%!important}}@media only screen and (max-width:480px){.tblLine{min-width:100%!important}}@media only screen and (max-width:480px){.bmeMblCenter img{margin:0 auto}}@media only screen and (max-width:480px){.bmeMblCenter,.bmeMblCenter div,.bmeMblCenter span{text-align:center!important;text-align:-webkit-center!important}}@media only screen and (max-width:480px){.bmeImageGutterRow,.bmeMblStackCenter .bmeShareItem .tdMblHide,.bmeNoBr br{display:none!important}}@media only screen and (max-width:480px){.bmeMblInline table.bmeCaptionTable,.bmeMblInline table.bmeImageTable,td.bmeMblInline{clear:none!important;width:50%!important}}@media only screen and (max-width:480px){.bmeMblInlineHide,.bmeShareItem .trMargin{display:none!important}}@media only screen and (max-width:480px){.bmeMblFollowCenter.tblContainer.mblSocialContain,.bmeMblInline table.bmeImageTable img,.bmeMblShareCenter.tblContainer.mblSocialContain{width:100%!important}}@media only screen and (max-width:480px){.bmeMblStack>.bmeShareItem{width:100%!important;clear:both!important}}@media only screen and (max-width:480px){.bmeShareItem{padding-top:10px!important}}@media only screen and (max-width:480px){.bmeMblStackCenter .bmeFollowItemIcon,.tdPart.bmeMblStackCenter{padding:0!important;text-align:center!important}}@media only screen and (max-width:480px){.bmeMblStackCenter>.bmeShareItem{width:100%!important}}@media only screen and (max-width:480px){td.bmeMblCenter{border:0 none transparent!important}}@media only screen and (max-width:480px){.bmeLinkTable.tdPart td{padding-left:0!important;padding-right:0!important;border:0 none transparent!important;padding-bottom:15px!important;height:auto!important}}@media only screen and (max-width:480px){.tdMblHide{width:10px!important}}@media only screen and (max-width:480px){.bmeShareItemBtn{display:table!important}}@media only screen and (max-width:480px){.bmeMblStack td{text-align:left!important}}@media only screen and (max-width:480px){.bmeMblStack .bmeFollowItem{clear:both!important;padding-top:10px!important}}@media only screen and (max-width:480px){.bmeMblStackCenter .bmeFollowItemText{padding-left:5px!important}}@media only screen and (max-width:480px){.bmeMblStackCenter .bmeFollowItem{clear:both!important;align-self:center;float:none!important;padding-top:10px;margin:0 auto}}@media only screen and (max-width:480px){.tdPart>table{width:100%!important}}@media only screen and (max-width:480px){.tdPart>table.bmeLinkContainer{width:auto!important}}@media only screen and (max-width:480px){.tdPart.mblStackCenter>table.bmeLinkContainer{width:100%!important}}.blk_parent,.blk_parent:first-child{float:left}.blk_parent:last-child{float:right}body,table[name=bmeMainBody]{background-color:#e2e2e2}td[name=bmePreHeader]{background-color:transparent}td[name=bmeHeader]{background:#fff;background-color:#1f37c8}table[name=bmeBody],td[name=bmeBody]{background-color:#fff}td[name=bmePreFooter]{background-color:#fff}td[name=bmeFooter]{background-color:transparent}.blk,td[name=tblCell]{font-family:initial;font-weight:400;font-size:initial}table[name=blk_blank] td[name=tblCell]{font-family:Arial,Helvetica,sans-serif;font-size:14px}[name=bmeMainContentParent]{border-color:grey;border-width:0;border-style:none;border-radius:0;border-collapse:separate;border-spacing:0;overflow:hidden}[name=bmeMainColumnParent]{border-color:transparent;border-width:0;border-style:none;border-radius:0}[name=bmeMainColumn]{border-color:transparent;border-width:0;border-style:none;border-radius:0;border-collapse:separate;border-spacing:0}[name=bmeMainContent]{border-color:transparent;border-width:0;border-style:none;border-radius:0;border-collapse:separate;border-spacing:0}
    </style>
</head>

<body marginheight=0 marginwidth=0 topmargin=0 leftmargin=0
    style="height: 100% !important; margin: 0; padding: 0; width: 100% !important;min-width: 100%;">

    <table width="100%" cellspacing="0" cellpadding="0" border="0" name="bmeMainBody"
        style="background-color: rgb(226 226 226);" bgcolor="#e2e2e2">
        <tbody>
            <tr>
                <td width="100%" valign="top" align="center">
                    <table cellspacing="0" cellpadding="0" border="0" name="bmeMainColumnParentTable">
                        <tbody>
                            <tr>
                                <td name="bmeMainColumnParent"
                                    style="border-collapse: separate; border: 0px none transparent; border-radius: 0px;">
                                    <table name="bmeMainColumn" class="bmeHolder bmeMainColumn"
                                        style="max-width: 600px; border-image: initial; border-radius: 0px; border-collapse: separate; border-spacing: 0px; overflow: visible;"
                                        cellspacing="0" cellpadding="0" border="0" align="center">
                                        <tbody>
                                            <tr>
                                                <td width="100%" class="blk_container bmeHolder" name="bmePreHeader"
                                                    valign="top" align="center"
                                                    style="color: rgb(102, 102, 102); border: 0px none transparent;"
                                                    bgcolor=""></td>
                                            </tr>
                                            <tr>
                                                <td width="100%" class="bmeHolder" valign="top" align="center"
                                                    name="bmeMainContentParent"
                                                    style="border: 0px none rgb(128, 128, 128); border-radius: 0px; border-collapse: separate; border-spacing: 0px; overflow: hidden;">
                                                    <table name="bmeMainContent"
                                                        style="border-radius: 0px; border-collapse: separate; border-spacing: 0px; border: 0px none transparent;"
                                                        width="100%" cellspacing="0" cellpadding="0" border="0"
                                                        align="center">
                                                        <tbody>
                                                            <tr>
                                                                <td width="100%" class="blk_container bmeHolder"
                                                                    name="bmeHeader" valign="top" align="center"
                                                                    style="border: 0px none transparent; background-color: #1f37c8; color: rgb(56, 56, 56);"
                                                                    bgcolor="#1fc899">
                                                                    <div id="dv_11" class="blk_wrapper" style="">
                                                                        <table width="600" cellspacing="0"
                                                                            cellpadding="0" border="0" class="blk"
                                                                            name="blk_divider" style="">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="tblCellMain"
                                                                                        style="padding: 5px 20px;">
                                                                                        <table class="tblLine"
                                                                                            cellspacing="0"
                                                                                            cellpadding="0" border="0"
                                                                                            width="100%"
                                                                                            style="border-top-width: 0px; border-top-style: none; min-width: 1px;">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td><span></span>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div id="dv_3" class="blk_wrapper" style="">
                                                                        <table class="blk" name="blk_image" width="600"
                                                                            border="0" cellpadding="0" cellspacing="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>
                                                                                        <table width="100%"
                                                                                            cellspacing="0"
                                                                                            cellpadding="0" border="0">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td class="bmeImage"
                                                                                                        style="padding: 20px; border-collapse: collapse;"
                                                                                                        align="center">
                                                                                                        <img src="https://www.serviciosoportunidades.com/images/oportunidadesServiciosFinancierosLogo.png"
                                                                                                            class="mobile-img-large"
                                                                                                            width="160"
                                                                                                            style="max-width: 1120px; display: block; width: 260px;"
                                                                                                            alt=""
                                                                                                            border="0">


                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div id="dv_18" class="blk_wrapper" style="">
                                                                        <table width="600" cellspacing="0"
                                                                            cellpadding="0" border="0" class="blk"
                                                                            name="blk_divider" style="">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="tblCellMain"
                                                                                        style="padding: 10px 20px;">
                                                                                        <table class="tblLine"
                                                                                            cellspacing="0"
                                                                                            cellpadding="0" border="0"
                                                                                            width="100%"
                                                                                            style="border-top-width: 0px; border-top-style: none; min-width: 1px;">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td><span></span>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div id="dv_1" class="blk_wrapper" style="">
                                                                        <table width="600" cellspacing="0"
                                                                            cellpadding="0" border="0" class="blk"
                                                                            name="blk_text">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>
                                                                                        <table cellpadding="0"
                                                                                            cellspacing="0" border="0"
                                                                                            width="100%"
                                                                                            class="bmeContainerRow">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td class="tdPart"
                                                                                                        valign="top"
                                                                                                        align="center">
                                                                                                        <table
                                                                                                            cellspacing="0"
                                                                                                            cellpadding="0"
                                                                                                            border="0"
                                                                                                            width="600"
                                                                                                            name="tblText"
                                                                                                            style="float:left; background-color:transparent;"
                                                                                                            align="left"
                                                                                                            class="tblText">
                                                                                                            <tbody>
                                                                                                                <tr>
                                                                                                                    <td valign="top"
                                                                                                                        align="left"
                                                                                                                        name="tblCell"
                                                                                                                        style="padding: 5px 20px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight: 400; color: rgb(56, 56, 56); text-align: left;"
                                                                                                                        class="tblCell">
                                                                                                                        <div
                                                                                                                            style="line-height: 125%; text-align: center;">
                                                                                                                            <span
                                                                                                                                style="font-size: 30px; color: #ffffff; line-height: 125%;">
                                                                                                                                <em><strong>Token para @if ($data->type == 'SOLICITUD')
                                                                                                                                    la consulta a centrales de riesgo
                                                                                                                                    @elseif($data->type == 'PREACTIVADA')
                                                                                                                                    realizar la preactivaci??n
                                                                                                                                    @else
                                                                                                                                    el avance
                                                                                                                                @endif </strong></em></span>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div id="dv_15" class="blk_wrapper" style="">
                                                                        <table width="600" cellspacing="0"
                                                                            cellpadding="0" border="0" class="blk"
                                                                            name="blk_text">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>
                                                                                        <table cellpadding="0"
                                                                                            cellspacing="0" border="0"
                                                                                            width="100%"
                                                                                            class="bmeContainerRow">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td class="tdPart"
                                                                                                        valign="top"
                                                                                                        align="center">
                                                                                                        <table
                                                                                                            cellspacing="0"
                                                                                                            cellpadding="0"
                                                                                                            border="0"
                                                                                                            width="600"
                                                                                                            name="tblText"
                                                                                                            style="float:left; background-color:transparent;"
                                                                                                            align="left"
                                                                                                            class="tblText">
                                                                                                            <tbody>
                                                                                                                <tr>
                                                                                                                  
                                                                                                                </tr>
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>

                                                                    <div id="dv_19" class="blk_wrapper" style="">
                                                                        <table width="600" cellspacing="0"
                                                                            cellpadding="0" border="0" class="blk"
                                                                            name="blk_divider" style="">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="tblCellMain"
                                                                                        style="padding-top:20px; padding-bottom:20px;padding-left:20px;padding-right:20px;">
                                                                                        <table class="tblLine"
                                                                                            cellspacing="0"
                                                                                            cellpadding="0" border="0"
                                                                                            width="100%"
                                                                                            style="border-top-width: 0px; border-top-style: none; min-width: 1px;">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td><span></span>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="100%" class="blk_container bmeHolder bmeBody"
                                                                    name="bmeBody" valign="top" align="center"
                                                                    style="color: rgb(56, 56, 56); border: 0px none transparent; background-color: rgb(255, 255, 255);"
                                                                    bgcolor="#ffffff">
                                                                    <div id="dv_22" class="blk_wrapper" style="">
                                                                        <table width="600" cellspacing="0"
                                                                            cellpadding="0" border="0" class="blk"
                                                                            name="blk_divider" style="">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="tblCellMain"
                                                                                        style="padding: 10px 20px;">
                                                                                        <table class="tblLine"
                                                                                            cellspacing="0"
                                                                                            cellpadding="0" border="0"
                                                                                            width="100%"
                                                                                            style="border-top-width: 0px; border-top-style: none; min-width: 1px;">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td><span></span>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div id="dv_20" class="blk_wrapper" style="">
                                                                        <table width="600" cellspacing="0"
                                                                            cellpadding="0" border="0" class="blk"
                                                                            name="blk_button" style="">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td width="20"></td>
                                                                                    <td align="center">
                                                                                        <table class="tblContainer"
                                                                                            cellspacing="0"
                                                                                            cellpadding="0" border="0"
                                                                                            width="100%">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td height="20">
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td align="center">
                                                                                                        <table
                                                                                                            cellspacing="0"
                                                                                                            cellpadding="0"
                                                                                                            border="0"
                                                                                                            class="bmeButton"
                                                                                                            align="center"
                                                                                                            style="border-collapse: separate;">
                                                                                                            <tbody>
                                                                                                                <tr>
                                                                                                                    <td style="border-radius: 0px; border: 0px none transparent; text-align: center; font-family: Arial, Helvetica, sans-serif; font-size: 14px; padding: 20px 40px; font-weight: bold; background-color: rgb(243, 156, 18);"
                                                                                                                        class="bmeButtonText">
                                                                                                                        <span
                                                                                                                            style="font-family: Tahoma, Arial, Helvetica, sans-serif; font-size: 16px; color: rgb(255, 255, 255);">
                                                                                                                            <a style="color:#FFFFFF;text-decoration:none;"
                                                                                                                                target="_blank">{{$data->token}}</a></span>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td height="20">
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td class="text-services"
                                                                                                        style="text-align: center;">
                                                                                                        <p
                                                                                                            style="font-family: Arial, Helvetica, sans-serif;font-size: 16px;font-weight: 400;color: rgb(56, 56, 56);">
                                                                                                            Cliente: {{$data->identificationNumber}}
                                                                                                           <b> </b>
                                                                                                        </p>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                 <tr>
                                                                                                    <td height="20">
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                    <td width="20"></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>


