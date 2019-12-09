<?php
    require "./php/php_ranking.php";
?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Sunouのサイト</title>

	<!-- JavaScript Link -->
	<script type="text/javascript" src=""></script>

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
        <div align = "center">
            <?php
                //scoreに値を代入
                if(isset($_POST["score"])){
                    $score = (int)$_POST["score"];

                    if($score == 0){
                        echo "<h1>スコアが0です。</h1>\n";
                        echo "<input type = button onclick=window.history.back(); value = 直前のページに戻る>\n";
                    }
                    else{
                        echo "<h1>獲得したスコアは".$score."点です</h1><br>\n";
                        $rank = new Rank_File("./data/rank.csv");

                        if($score > $rank->rank_datas[9][1]){
                            echo "<h2>おめでとう！ランキング更新したぞ！</h2>\n";
                            echo "<h2>更新したい場合は下記の記入して送信してね。</h2><br>\n";
                            echo "<form action = ./pazle_ranking.php method = post>\n";
                            echo "<div class = form-group>\n";
                            echo "<label for = name>名前</label>\n";
                            echo '<input style = "width:300px;" type = "text" class = "form-control" name = "name" id = "name">', "\n";
                            echo "</div>", "\n";
                            echo '<input type = "hidden" name = "score" value = "', $score, '">', "\n";
                            echo '<input type = "hidden" name = "check" value = "', $rank->check_num[1], '">', "\n";
                            echo '<button type = "submit" class="btn btn-info">送信</button>', "\n";
                            echo '</form>', "\n";
                        }

                        else{
                            echo "<h2>残念！ランキング更新出来なかった。</h2>\n";
                            echo "<h2>".$rank->rank_datas[9][1]."点を超えればランキング更新ができるから頑張ろう！</h2>\n";
                            echo "<input type = button onclick=window.history.back(); value = 直前のページに戻る>\n";
                        }
                    }
                }
                else{
                    echo "<h1>スコアが0です。</h1>\n";
                    echo "<input type = button onclick=window.history.back(); value = 直前のページに戻る>\n";
                }
            ?>
        </div>
	</div>
</body>

</html>