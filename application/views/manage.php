<div class="container">
    <form action="/manage" method="post">
		<input type="hidden" name="action" value="isPost" />
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#home">Setting</a>
            </li>
            <li>
                <a data-toggle="tab" href="#menu3" class="tab-item">Sell Robot</a>
            </li>
            <li>
                <a data-toggle="tab" href="#menu2" class="tab-item">Register</a>
            </li>
            <li>
                <a data-toggle="tab" href="#menu1" class="tab-item">Reboot</a>
            </li>
        </ul>

        <div class="tab-content">
            {results}
                <font color="red"><b>{output}</b></font>
                <br/>
            {/results}
            <div id="home" class="tab-pane fade in active">
                <h3>Important Info</h3>
                <h5>Token: {token}</h5>
                <h5>API key: {apiKey}</h5>
                <h5>Number of parts processed: {partsId}</h5>
                <h5>Number of robots made: {robotsId}</h5>
            </div>
            <div id="menu3" class="tab-pane fade">
                <h3>Assembled Robots</h3>
                <p>Clicking any of the Sell buttons sends a message to the PRC's https://umbrella.jlparry.com/work/buymybot/(part1)/(part2/(part3)?key={apiKey}. Which will sell those parts together as a robot</p>
                <div class="col-sm-12 assembled">
                <table class="table table-responsive">
                    <tr style="text-align: center">
                        <td>
                            <h3>Bot Code</h3>
                        </td>
                        <td>
                            <h3>Parts Used</h3>
                        </td>
                        <td>
                            <h3>Select</h3>
                        </td>
                    </tr>
                    {robots}
                    <tr class="aparts">
                        <td style="width:20%">
                            <h5><b>{botCode}</b></h5>
                        </td>
                        <td style="width:70%">
                            <table class="table table-responsive">
                                <tr>
                                    <td style="width:66%">
                                        <img src="/img/parts/{topId}.png" title="{topCode}"></td>
                                    <td style="width:33%">
                                        <h5>{topId}</h5>
                                        <h5>{topCode}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:66%">
                                        <img src="/img/parts/{torsoId}.png" title="{torsoCode}">
                                    </td>
                                    <td style="width:33%">
                                        <h5>{torsoId}</h5>
                                        <h5>{torsoCode}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:66%">
                                        <img src="/img/parts/{bottomId}.png" title="{bottomCode}">
                                    </td>
                                    <td style="width:33%">
                                        <h5>{bottomId}</h5>
                                        <h5>{bottomCode}</h5>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td class="assembly-td" style="width:10%">
                            <input type="checkbox" name="botInfo[]" value="{id} {botCode} {topCode} {torsoCode} {bottomCode}" />
                        </td>
                    </tr>
                    {/robots}
                </table>
            </div>
            <div class="col-sm-12">
                <input type="submit" id="sellBot" class="btn btn-success btn-block" name="submit" value="Sell Robot" />
            </div>
            </div>
            <div id="menu2" class="tab-pane fade">
                <p>Upon entering the correct password, sends a message to PRC's https://umbrella.jlparry.com/work/registerme/mango/{token} endpoint to establish a new session on PRC.</p>
                <div style="text-align: center;">
                    <h3>Input Token Here:</h3>
                    <input type="text" name="registerTokenCheck" />
                </div>
                <input type="submit" id="register" class="btn btn-info btn-block" name="submit" value="Register" />
            </div>
            <div id="menu1" class="tab-pane fade">
                <p>This Reboot button sends a message to the Panda Research Center's https://umbrella.jlparry.com/work/rebootme?key={apiKey}. On a successful reboot, this factory's current parts and history list will be emptied and its balance will be set to 2000.</p>
                <div style="text-align: center;">
                    <h3>Input Token Here:</h3>
                    <input type="text" name="rebootTokenCheck" />
                </div>
                <input type="submit" id="reboot" class="btn btn-danger btn-block" name="submit" value="Reboot Me" />
            </div>
        </div>
    </form>
</div>
