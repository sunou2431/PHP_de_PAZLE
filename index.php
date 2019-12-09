<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Pazle</title>

	<!-- JavaScript Link -->
	<script type="text/javascript" src="./js/pazle.js"></script>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

	<!-- CSSリンク -->
	<link rel="stylesheet" href="./css/pazle_index.css" type="text/css">

	<!-- CSS簡易メモ -->
	<!-- 既存のものを変える場合は、コマンドのみ -->
	<!-- クラスを作成する場合は、最初にカンマ -->

	<style>
	</style>
</head>

<body>
	<!-- 一番上をおしゃれにする -->
	<?php
		$hedder = file_get_contents("http://sunou2431.work/hedder.html");
		echo $hedder;
	?>

	<div class = "starter-template">
		<h1 align="center">パズルゲーム</h1>
		<p align = "center"><a href = "./pazle_ranking.php">ランキング</a> | <a href = "../">Home</a></p>
		<div class = "continer">
			<div class = "row" align = "center">
				<table>
					<tr>
						<td colspan = "2" align = center>
							<p id = "if_del">頑張ってね</p>
						</td>
					</tr>
					<tr>
						<td>
							<script language = "JavaScript">
								set_block_data();
								set_block();
								view_block();
							</script>
						</td>

						<td align = center>
							<input type = "button" value = "リセット" onclick = "reset_block()"><br><br>
							<p>スコアは</p>
							<p id = "score">0</p><br><br>
							<input type = "button" value = "スコア送信" onclick = "send_score(score)">
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</body>

</html>