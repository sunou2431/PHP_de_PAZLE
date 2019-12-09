<?php
    class Rank_File{
        public $rank_datas = array();
        public $check_num;

        public function __construct($filename){
            $this->filelead($filename);
        }

        private function filelead($filename){
            $contents = file_get_contents($filename);
            $dammy_datas = explode("\n", $contents);
            foreach($dammy_datas as $data){
                $this->rank_datas[] = explode(",", $data);
            }
            $check = file_get_contents("./data/check.csv");
            $this->check_num = explode(",", $check);
            $this->check_num[1] = (int)$this->check_num[1];
        }

        public function ranking_sort(){
            foreach($this->rank_datas as $data){
                $scores[] = (int)$data[1];
            }
            array_multisort($scores, SORT_DESC, SORT_NUMERIC, $this->rank_datas);
        }

        public function ranking_send($filename){
            $fp = fopen($filename, "w");
            foreach($this->rank_datas as $data){
                if($data[0] != ""){
                    $line = implode(',', $data);
                    fwrite($fp, $line . "\n");
                }
            }
            fclose($fp);

            $this->check_num[1] = ($this->check_num[1] + 1) % 10;
            $line = implode(',', $this->check_num);
            file_put_contents("./data/check.csv", $line);
        }

        public function ranking_view(){
            echo "<tbody>\n";
            $num = 1;
            foreach($this->rank_datas as $data){
                if($data[0] != ""){
                    echo "<tr class = ranking_table_tr>\n";
                    echo "<td>$num</td>";
                    echo "<td>".$data[1]."</td>\n";
                    echo "<td>".$data[0]."</td>\n";
                    echo "<td>".$data[2]."</td>\n";
                    echo "</tr>\n";
                    $num++;
                }
            }
            echo "</tbody>\n";
        }
    }
?>