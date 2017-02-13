<div class="container-fluid">
    <div  class="col-sm-12 toptitle"><h1 class="sectitle">Robot Parts</h1></div>
    <div class="col-sm-12">
        <!-- Top -->
        <div class="col-sm-4">
            <table class="table table-responsive">
                <thead>
                    <th class="assembly-header">
                        <h3>Torso</h3>
                    </th>
                </thead>
                {torso}
                <tr>
                    <td>
                        <img class="img-responsive" src="/img/parts/{partCode}.png" title="{partCode}">
                    </td>
                    <td>
                        <input type="checkbox" name="torso" value="{id}">
                    </td>
                </tr>
                {/torso}
            </table>
        </div>
        <!-- Torso -->
        <div class="col-sm-4">
            <table class="table table-responsive">
                <thead>
                    <th class="assembly-header">
                        <h3>Top</h3>
                    </th>
                </thead>
                {top}
                <tr>
                    <td>
                        <img class="img-responsive" src="/img/parts/{partCode}.png" title="{partCode}">
                    </td>
                    <td >
                        <input type="checkbox" name="top" value="{id}" </td>
                </tr>
                {/top}
            </table>
        </div>
        <!-- Legs -->
        <div class="col-sm-4">
            <table class="table table-responsive">
                <thead>
                    <th class="assembly-header">
                        <h3>Bottom</h3>
                    </th>
                </thead>
                {bottom}
                <tr>
                    <td>
                        <img class="img-responsive" src="/img/parts/{partCode}.png" title="{partCode}">
                    </td>
                    <td>
                        <input type="checkbox" name="bottom" value="{id}" </td>
                </tr>
                {/bottom}
            </table>
        </div>
    </div>
    <div class="col-sm-12" id="assembledbots">
        <div class="col-sm-6">
            <button type="button" class="btn btn-info btn-block">Build It</button>
        </div>
        <div class="col-sm-6">
            <button type="button" class="btn btn-danger btn-block">Return to Head Office</button>
        </div>
    </div>
    <div  class="col-sm-12"><h1 class="sectitle">Assembled Robots</h1></div>
    <div class="col-sm-12 assembled">
        <table class="table table-responsive">
            {robots}
            <tr>
                <td>
                    <table class="table table-responsive">
                        <tr>
                            <img style="height:50%" src="/img/parts/{topId}.png" title="{partCode}">
                        </tr>
                        <tr>
                            <img style="height:50%" src="/img/parts/{bottomId}.png" title="{partCode}">
                        </tr>
                        <tr>
                            <img style="height:50%" src="/img/parts/{torsoId}.png" title="{partCode}">
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
