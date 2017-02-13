<h1>Assembly</h1>

<div class="container-fluid">
    <div class="col-sm-12">
        <table class="table">
            <!-- Top -->
            <td>
                <table class="table">
                    <thead>
                        <th class="assembly-header" colspan="3">
                            Torso
                        </th>
                    </thead>
                    {torso}
                    <tr>
                        <td class="assembly-td">
                            <img class="img-responsive" src="/img/parts/{partCode}.png" title="{partCode}">
                        </td>
                        <td class="assembly-td">
                            <input type="checkbox" name="torso" value="{id}">
                        </td>
                    </tr>
                    {/torso}
                </table>
            </td>
            <!-- Torso -->
            <td>
                <table class="table">
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
                            <input type="checkbox" name="top" value="{id}" </td>
                    </tr>
                    {/top}
                </table>
                </td>
                <!-- Legs -->
                <td>
                    <table class="table">
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
                                <input type="checkbox" name="bottom" value="{id}" </td>
                        </tr>
                        {/bottom}
                    </table>
                    </td>
        </table>
    </div>
    <div class="col-sm-12">
        <div class="col-sm-6">
            <button type="button" class="btn btn-info btn-block">Build It</button>
        </div>
        <div class="col-sm-6">
            <button type="button" class="btn btn-danger btn-block">Return to Head Office</button>
        </div>
    </div>
    <h1>Assembled Robots</h1>
    <div class="col-sm-12">
        <table class="table">
            {robots}
            <tr>
                <td class="assembly-td">
                    <table>
                        <tr>
                            <img class="img-responsive" style="height:25%;" src="/img/parts/{topId}.png" title="{partCode}">
                        </tr>
                        <tr>
                            <img class="img-responsive" style="height:25%;" src="/img/parts/{bottomId}.png" title="{partCode}">
                        </tr>
                        <tr>
                            <img class="img-responsive" style="height:25%;" src="/img/parts/{torsoId}.png" title="{partCode}">
                        </tr>
                    </table>
                </td>
                <td class="assembly-td">
                    <input type="checkbox" name="torso" value="{id}" </td>
            </tr>
            {/robots}
        </table>
    </div>
    <div class="col-sm-12">
        <button type="button" class="btn btn-success btn-block">Ship to Head Office</button>

    </div>
</div>
