var block_data = new Array(10);
var img_data = [
	'./img/pazle/pazu0.jpeg',
	'./img/pazle/pazu1.jpeg',
	'./img/pazle/pazu2.jpeg',
	'./img/pazle/pazu3.jpeg',
	'./img/pazle/pazu4.jpeg',
	'./img/pazle/pazu5.jpeg',
	'./img/pazle/pazu6.jpeg',
	'./img/pazle/pazu7.jpeg',
	'./img/pazle/pazu8.jpeg',
	'./img/pazle/pazu9.jpeg'
];
var score = 0;
var del_num = 0;

//ブロックを２次元配列として扱うための処理
function set_block_data(){
	for(var x = 0;x < 10 ;x++){
		block_data[x] = new Array(8);
	}
}

//ブロックをデータに格納
function set_block(){
	for(var x = 0; x < 10 ; x++){
		for(var y = 0; y < 8 ; y++){
			block_data[x][y] = Math.floor( Math.random() * 4 );
		}
	}
}

//最初の一回目のみのブロックを置く処理
function view_block(){
	document.open();
	document.writeln("<table>");
	for(var y = 0; y < 8 ; y++){
		document.writeln("<tr>");
		for(var x = 0; x < 10 ; x++){
			document.write("<td>");
			document.write("<a href=#! onmouseover=view_data(" + x + "," + y + ") onclick=del_block(" + x + "," + y +")>");
			document.write("<img src=" + img_data[block_data[x][y]] + " id=block_" + x + "_" + y + " class = pazle_img>");
			document.write("</a>");
			document.writeln("</td>");
		}
		document.writeln("</tr>");
	}
	document.writeln("</table>");
	document.close();
}

//データを消して、ソートする
function del_block(x, y){
	if((del_num >= 2) && (block_data[x][y] >= 5)){
		del_block_data(block_data[x][y]);
		sort_tate_block();
		sort_yoko_block();
		score = score + if_score();

		//全消し処理
		if(block_data[0][7] == 4){
			set_block();
		}
		view_data(x, y);
		now_score();
	}
}

//実際にブロックを消す処理
function del_block_data(del_num){
	for(var y = 0;y < 8 ; y++){
		for(var x = 0; x < 10;x++){
			if(block_data[x][y] == del_num){
				block_data[x][y] = 4;
			}
		}
	}
}

//まずは縦列をソート
function sort_tate_block(){
	var dammy;
	for(var x = 0; x < 10;x++){
		for(var end_y = 0; end_y <= 6; end_y++){
			if(block_data[x][end_y] != 4){
				break;
			}
		}
		for(var y = end_y; y <= 6; y++){
			for(var y_old = 7; y_old  > y ; y_old--){
				if(block_data[x][y_old] == 4){
					dammy = block_data[x][y_old];
					block_data[x][y_old] = block_data[x][y_old - 1];
					block_data[x][y_old - 1] = dammy;
				}
			}
		}
	}
}

//次に横列をソート
function sort_yoko_block(){
	for(var start_x = 9; x >= 1; x--){
		if(block_data[x][7] != 4){
			break;
		}
	}
	for(var x = start_x; x >= 1; x--){
		for(var x_old = 0; x_old < x; x_old++){
			if(block_data[x_old][7] == 4){
				for(var y = 0; y < 8;y++){
					block_data[x_old][y] = block_data[x_old + 1][y];
					block_data[x_old + 1][y] = 4;
				}
			}
		}
	}
}

//どこを消すかわかりやすく、その後仮の点数を返す
function view_data(x, y){
	if(block_data[x][y] <= 3){
		reset();
		if_del_block(x, y);
		change_block_data();
	}
	if(block_data[x][y] == 4){
		reset();
		del_num = 0;
		change_block_data();
	}

	var text = document.getElementById("if_del");
	if(del_num >= 2 && block_data[x][y] >= 5 && block_data[x][y] <= 8){
		text.textContent = "そこを消すと" + del_num + "個数消えて" + if_score() + "点増えるよ";
	}
	else{
		text.textContent = "そこは消せないよ";
	}
}

//消した場合のスコア計算
function if_score(){
	var dammy = del_num - 2;
	return 2 * dammy * dammy;
}

//ブロックのイメージ画像更新
function change_block_data(){
	var id;
	var text;
	for(var y = 0;y < 8 ; y++){
		for(var x = 0; x < 10;x++){
			id = "block_" + x + "_" + y;
			text = document.getElementById(id);
			text.src = img_data[block_data[x][y]];
		}
	}
}

//ブロックを赤色から帰るための処理
function reset(){
	for(var y = 0; y < 8 ; y++){
		for( var x = 0; x < 10; x++){
			block_data[x][y] = block_data[x][y] % 5;
		}
	}
}

//消すところを赤く描画する
function if_del_block(x_old, y_old){
	var flg = 1;
	var num = block_data[x_old][y_old];
	block_data[x_old][y_old] = block_data[x_old][y_old] + 5;

	while(flg == 1){
		flg = 0;
		for(var y = 0; y < 8 ; y++){
			for(var x = 0; x < 10; x++){
				if(block_data[x][y] == num + 5){
					if(x > 0){
						if(block_data[x - 1][y] == num){
							block_data[x - 1][y] = num + 5;
							flg = 1;
						}
					}
					if(x < 9){
						if(block_data[x + 1][y] == num){
							block_data[x + 1][y] = num + 5;
							flg = 1;
						}
					}
					if(y > 0){
						if(block_data[x][y - 1] == num){
							block_data[x][y - 1] = num + 5;
							flg = 1;
						}
					}
					if(y < 7){
						if(block_data[x][y + 1] == num){
							block_data[x][y + 1] = num + 5;
							flg = 1;
						}
					}
				}
			}
		}
	}
	del_num = 0;
	for(y = 0; y < 8 ; y++){
		for(x = 0; x < 10; x++){
			if(block_data[x][y] == num + 5){
				del_num++;
			}
		}
	}
}

//現在のスコア描画
function now_score(){
	var text = document.getElementById("score");
	text.textContent = score;
}

//もろもろを最初からにする
function reset_block(){
	score = 0;
	set_block();
	change_block_data();
	now_score();
}

//スコア送信
function send_score(score) {
     
	var form = document.createElement('form');
	var request = document.createElement('input');
 
	form.method = 'POST';
	form.action = './pazle_send.php';
 
	request.type = 'hidden'; //入力フォームが表示されないように
	request.name = 'score';
	request.value = score;
 
	form.appendChild(request);
	document.body.appendChild(form);
 
	form.submit();
}