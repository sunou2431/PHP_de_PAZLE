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
    <!--　POST送信がある場合ランキング処理を行う -->
    <?php
        $rank = new Rank_File("./data/rank.csv");
		if(isset($_POST["score"])){
            $check = (int)$_POST["check"];
            if($rank->check_num[1] == $check){
                $score = $_POST["score"];
                $name = $_POST["name"];
                $days = date("Y-m-d H:i:s");
                $dammy_data = array($name, $score, $days);
                array_push($rank->rank_datas, $dammy_data);

                $rank->ranking_sort();
                $rank->ranking_send("./data/rank.csv");
            }
		}
	?>	

	<!-- 一番上をおしゃれにする -->
	<?php
		$hedder = file_get_contents("http://sunou2431.work/hedder.html");
		echo $hedder;
	?>

	<div class = "starter-template">
		<div class = "conteiner" align = "center">
            <p><a href = "./">パズルゲーム画面</a> | <a href = "../">Home</a></p>
            <table class = "table-hover">
                <thead>
                    <tr class = "ranking_table_tr">
                        <td class = "ranking_table_juni">
                            順位
                        </td>
                        <td class = "ranking_table_score">
                            スコア
                        </td>
                        <td class = "ranking_table_name">
                            名前
                        </td>
                        <td class = "ranking_table_day">
                            日付
                        </td>
                    </tr>
                </thead>
                <?php
                    $rank->ranking_view();
                ?>
            </table>
        </div>
	</div>
</body>

</html>