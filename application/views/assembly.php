<h1>Assembly</h1>

<div class="container-fluid">
    <table cellpadding="3" cellspacing="3" width="100%" border="2">
        <!-- Top -->
        <td>
            <table width="100%">
                <thead>
                    <th class="assembly-header" colspan="3" >
                        Torso
                    </th>
                </thead>
                {torso}
                <tr>
                    <td class="assembly-td">
                        <img class="img-responsive" src="/img/parts/{partCode}.png" title="{partCode}">
                    </td>
                    <td class="assembly-td">
                        <input type="checkbox" name="torso" value="{id}"
                    </td>
                </tr>
                {/torso}
            </table>
        </td>
        <!-- Torso -->
        <td>
            <table width="100%">
                <thead>
                <th class="assembly-header" colspan="3">
                    Top
                </th>
                </thead>
                {top}
                <tr>
                    <td width="50%">
                        <img class="img-responsive" src="/img/parts/{partCode}.png" title="{partCode}">
                    </td>
                    <td class="assembly-td">
                        <input type="checkbox" name="top" value="{id}"
                    </td>
                </tr>
                {/top}
            </table>
        </td>
        <!-- Legs -->
        <td>
            <table width="100%">
                <thead>
                <th class="assembly-header" colspan="3">
                    Bottom
                </th>
                </thead>
                {bottom}
                <tr>
                    <td width="50%">
                        <img class="img-responsive" src="/img/parts/{partCode}.png" title="{partCode}">
                    </td>
                    <td class="assembly-td">
                        <input type="checkbox" name="bottom" value="{id}"
                    </td>
                </tr>
                {/bottom}
            </table>
        </td>
    </table>

    <div class="row">
        <table width="100%" style="align-content: center">
            <tr>
                <td width="50%">
                    <button type="button" class="button">Build It</button>
                </td>
                <td width="50%">
                    <button type="button" class="button">Return to Head Office</button>
                </td>
            </tr>
        </table>
    </div>

    <h1>Assembled Robots</h1>
    <div class="row" >
        <table width="50%">
            {robots}
            <tr>
                <td class="assembly-td">
                    <table>
                        <tr>
                            <img class="img-responsive"  style="width:25%;height:25%;" src="/img/parts/{topId}.png" title="{partCode}">
                        </tr>
                        <tr>
                            <img class="img-responsive"  style="width:25%;height:25%;" src="/img/parts/{bottomId}.png" title="{partCode}">
                        </tr>
                        <tr>
                            <img class="img-responsive"  style="width:25%;height:25%;" src="/img/parts/{torsoId}.png" title="{partCode}">
                        </tr>
                    </table>
                </td>
                <td class="assembly-td">
                    <input type="checkbox" name="torso" value="{id}"
                </td>
            </tr>
            {/robots}
        </table>
    </div>
    <div class="row">
        <table width="100%" style="align-content: center">
            <tr>
                <td width="100%">
                    <button type="button" class="button">Ship to Head Office</button>
                </td>
            </tr>
        </table>
    </div>
</div>
