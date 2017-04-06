<div class="container container-fluid partscontainers">
	{results}
		<font color="red"><b>{output}</b></font>
		<br/>
	{/results}
	<form action="/assembly" method="post">
		<input type="hidden" name="action" value="isPost" />
		<div  class="col-sm-12 toptitle"><h1 class="sectitle">Robot Parts</h1></div>
		<div class="col-sm-12">
			<!-- Top -->
			<div class="col-sm-4">
				<table class="table table-responsive">
					<thead>
						<th class="assembly-header">
							<h3>Top</h3>
						</th>
					</thead>
					{top}
					<tr class="aparts">
						<td>
							<a href="/part/{id}">
								<img class="img-responsive" src="/img/parts/{partCode}.png" title="{partCode}">
							</a>
						</td>
						<td>
                            <table class="table table-responsive">
                                <tr>
                                    <input type="checkbox" name="topSelected[]" value="{id} {partCode} {caCode}" />
                                </tr>
                                <tr>
                                    <h5>{partCode}</h5>
                                    <h5>{caCode}</h5>
                                </tr>
                            </table>
						</td>
					</tr>
					{/top}
				</table>
			</div>
			<!-- Torso -->
			<div class="col-sm-4">
				<table class="table table-responsive">
					<thead>
						<th class="assembly-header">
							<h3>Torso</h3>
						</th>
					</thead>
					{torso}
					<tr class="aparts">
						<td>
							<a href="/part/{id}">
								<img class="img-responsive" src="/img/parts/{partCode}.png" title="{partCode}">
							</a>
						</td>
						<td>
                            <table class="table table-responsive">
                                <tr>
                                    <input type="checkbox" name="torsoSelected[]" value="{id} {partCode} {caCode}" />
                                </tr>
                                <tr>
                                    <h5>{partCode}</h5>
                                    <h5>{caCode}</h5>
                                </tr>
                            </table>
						</td>
					</tr>
					{/torso}
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
					<tr class="aparts">
						<td>
							<a href="/part/{id}">
								<img class="img-responsive" src="/img/parts/{partCode}.png" title="{partCode}">
							</a>
						</td>
						<td>
                            <table class="table table-responsive">
                                <tr>
                                    <input type="checkbox" name="bottomSelected[]" value="{id} {partCode} {caCode}" />
                                </tr>
                                <tr>
                                    <h5>{partCode}</h5>
                                    <h5>{caCode}</h5>
                                </tr>
                            </table>
						</td>
					</tr>
					{/bottom}
				</table>
			</div>
		</div>
		<div class="col-sm-12" id="assembledbots">
			<div class="col-sm-6">
				<input id="buildBot" type="submit" class="btn btn-info btn-block" name="submit" value="Build Bot" />
			</div>
			<div class="col-sm-6">
				<input id="return" type="submit" class="btn btn-danger btn-block" name="submit" value="Return to Head Office" />
			</div>
		</div>
		<div  class="col-sm-12"><h1 class="sectitle">Assembled Robots</h1></div>
		<div class="col-sm-12 assembled">
			<table class="table table-responsive">
				<tr style="text-align: center">
					<td>
						<h3>Bot Code</h3>
					</td>
					<td>
						<h3>Parts Used</h3>
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
				</tr>
				{/robots}
			</table>
		</div>
	</form>
</div>
