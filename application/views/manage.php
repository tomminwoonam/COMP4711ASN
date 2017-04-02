<div class="container">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">Setting</a></li>
        <li><a data-toggle="tab" href="#menu1" class="tab-item">Reboot</a></li>
        <li><a data-toggle="tab" href="#menu2" class="tab-item">Register me</a></li>
        <li><a data-toggle="tab" href="#menu3" class="tab-item">Sell assembled</a></li>
    </ul>

    <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
            <p>Settings options</p>
            <p>If you use a control table to save key/value pairs for configuring or managing your app, provide a way to display/edit these. For instance, this could include settings that influence any AI you have for suggesting bots to build, or it could include the base URL for the PRC, to avoid hard-coding it.</p>
        </div>
        <div id="menu1" class="tab-pane fade">
            <a href="/work/buybox" class="btn btn-info" role="button">Reboot</a>
            <p>Provide a button or link to "Reboot" your plant. It should send a message to the Panda Research Center's /work/rebootme, and get an Ok response or a self-explanatory error message. On successful "reboot", empty your inventory & history - you are starting from scratch again, with the appropriate starting balance for a new plant.</p>
        </div>
        <div id="menu2" class="tab-pane fade">
            <p>>Provide a mini-form for registering with the PRC. You will need your plant name, which can be saved as a configuration setting inside your app, and your secret token, which should not be stored anywhere inside your app or repo. Send a message to PRC's /work/registerme/team/token endpoint; it will return an appropriate message. Substitute your team name and token, of course. This will establish a session on PRC. If yours closes, you will need to re-register.</p>
        </div>
        <div id="menu3" class="tab-pane fade">
            <p>Finally, here is where you can sell assembled bot to the PRC. Present a list of the ones you have built, with suitable links to sell them to the PRC one at a time, namely /work/buymybot/part1/part2/part3, where parts 1 through 3 are the tokens for the three parts that make up your bot. The server will respond with Ok or Nak with a self-explanatory error message. If "Ok", you can remove the bot from your database. The PRC will automatically credit your account balance.</p>
        </div>
    </div>
</div>
