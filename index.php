<?php

// #############################
// //pop函数弹出的值为单元元素本身，不会再压进数组返回
// #############################
// $a= [1,2,3,4,];
// $b=[];
// $b[] = array_pop($a);
// var_dump($b);die();
// 
// ############################
// //for里结束判断依据是动态的
// ############################
// $oprator = [1,2,3,4,5];
// $count = 0;
// for($i=0;$i<count($oprator)-3;$i++){
//     array_pop($oprator);
//     $count ++;
// }
// echo "$count";
// var_dump($oprator);
// die();
// $j=1;
// for($i=0;$i<$j;$i++){
//     if ($j<10) {
//         $j++;
//     }
// }
// echo "$j";die();


$data = "1+2*3-(4/2)";//5
compute($data);

function compute($strings){
    $maps       = ["+"=>0,"-"=>0,'*'=>0,'/'=>0];
    $high_maps  = ["*"=>0,"/"=>0];
    $low_maps   = ["+"=>0,"-"=>0];
    $str_point  = 0;
    $bra_point  = [];
    $oprator    = [];
    $suffix     = [];
    while (isset($strings[$str_point])) {
        if (is_numeric($strings[$str_point])) {
            $suffix[] = $strings[$str_point];
            $str_point++;
            continue;
        }
        if ($strings[$str_point]=="(") {
            $oprator[]  = $strings[$str_point];
            $bra_point[] = count($oprator);
            $str_point++;
            continue;
        }
        if (empty($oprator)) {
            $oprator[]  = $strings[$str_point];
            $str_point++;
            continue;
        }
        $opr_count = count($oprator);
        if ($strings[$str_point]==")") {
            $bra_count = count($bra_point);
            for($i=0;$i<$opr_count-$bra_point[$bra_count-1];$i++){
                $suffix[] = array_pop($oprator);
            }
            array_pop($oprator);
            $str_point++;
            continue;
            
        }
        if (isset($low_maps[$strings[$str_point]])) {
            while(isset($maps[$oprator[$opr_count-1]])) {
                $suffix[] = array_pop($oprator);
                $opr_count--;
                if ($opr_count===0) {
                    break;
                }
            }
            $oprator[]  = $strings[$str_point];
            $str_point++;
            continue;
        }

        if (isset($high_maps[$strings[$str_point]])) {
            while (isset($high_maps[$oprator[$opr_count-1]])) {
                $suffix[] = array_pop($oprator);
                $opr_count--;
                if ($opr_count===0) {
                    break;
                }
            }
            $oprator[]  = $strings[$str_point];
            $str_point++;
            continue;
        }
        echo "error";die;
    }
    $opr_count = count($oprator);
    for($i=0; $i<$opr_count; $i++){
        $suffix[] = array_pop($oprator);
    }
    $array_point = -1;
    $tmp_arr     = [];
    foreach ($suffix as $key => $value) {
        if (is_numeric($value)) {
            $tmp_arr[] =intval($value);
        }else{
            switch ($value) {
                case '+':
                    $a = array_pop($tmp_arr);
                    $b = array_pop($tmp_arr);
                    $tmp_arr[] = $b+$a;
                    echo $b+$a;
                    break;
                case '-':
                    $a = array_pop($tmp_arr);
                    $b = array_pop($tmp_arr);
                    $tmp_arr[] = $b-$a;
                    echo $b-$a;
                    break;
                case '*':
                    $a = array_pop($tmp_arr);
                    $b = array_pop($tmp_arr);
                    $tmp_arr[] = $b*$a;
                    echo $b*$a;
                    break;
                case '/':
                    $a = array_pop($tmp_arr);
                    $b = array_pop($tmp_arr);
                    $tmp_arr[] = $b/$a;
                    echo $b/$a;
                    break;
                
                default:
                    echo "error2";die();
                    break;
            }
        }
        $array_point ++;
    }

    var_dump($tmp_arr);die();

}

//
//
//
//
// $a = 3;
// $b = &$a;
// echo "ashi".$a."<br>";
// echo "bshi"."$b"."<br>";
// $c = 4;
// $b = &$c;
// echo "bshi".$b."<br>";
// echo "ashi".$a."<br>";die();

// $nums   = [2, 7, 11, 34,15,4,5];
// $target = 9;
// $obj = new Solution;
// $result = $obj->twoSum($nums,$target);
// var_dump($result);die();
// 
// 
// $monkeys = array(1 , 2 , 3 , 4 , 5 , 6 , 7, 8 , 9 , 10); //monkey的编号
// echo $monkeys[-1];die();
// $m = 4; //数到第几只的那只猴子被踢出去
// function killMonkey($monkeys , $m , $current = 0){
//   $number = count($monkeys);
//     $num = 1;
//     if(count($monkeys) == 1){
//       echo $monkeys[0]."成为猴王了";
//       return;
//     }
//     else{
//       while($num++ < $m){
//           $current++ ;
//           $current = $current%$number;
//         }
//         echo $monkeys[$current]."的猴子被踢掉了<br/>";
//         array_splice($monkeys , $current , 1);
//         killMonkey($monkeys , $m , $current);
//     }
// }
// killMonkey($monkeys , $m);
// die();
$n = 6;
$m = 8;
$arr = range(1, $n);
$count = $n;
while ($count !=1) {
    $tmp = $m % $count;
    $count--;
    if ($tmp==0) {
        $arr_1=array_pop($arr);
        echo $arr_1[0]."被淘汰<br>";
    }else{
        echo $arr[$tmp-1]."被淘汰<br>";
    }
    $tmp_arr = array_splice($arr,0,$tmp);
    array_pop($tmp_arr);
    if (empty($tmp_arr)&$count==1) {
        echo $arr[0]."成为猴王了";die();
        // var_dump($arr);die();
    }
    if (empty($arr)&$count==1) {
        echo $tmp_arr[0]."成为猴王了";die();
        // var_dump($tmp_arr);die();
    }
    $arr=array_merge($arr,$tmp_arr);
    var_dump($arr);echo "<br>";
}
echo "error";
var_dump($tmp_arr);
var_dump($arr);die();

// 
// 
// 
$obj = new Index;
$result = $obj->testForSort();
die();
class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[]
     */
    function twoSum($nums, $target) {
        $arr=[];
        $keys=[];
        foreach ($nums as $k => $v) {
            if (isset($arr[$target-$v])) {
                $keys=[$arr[$target-$v],$k];
                break;
            }else{
                $arr[$v] = $k;
            }
        }
        return $keys;
    }
}
class Index
{  

    public function testForSort(){
        //$arr = [2,4,5,6,3,1,9,7,8];
        //        0,1,2,3,4,5,6,7,8,

        //1,2,3,4,5,6,7,8,9
        //
        //
        ###
        ###  case 1:打擂台法 选择排序
        // //
        // //
        // //双遍历数组，寻找最大/最小，复杂度=n+(n-1)+(n-2)……+3+2+1="(n+1)*n/2"/"n*n/2"
        // $aim_arr      = [];
        // $arr_count    = count($arr);
        // $k            = -1;
        // $t = 0;
        // for($i=0;$i<$arr_count;$i++){
        //     $min        = 100;
        //     foreach ($arr as $key => $value) {
        //         if ($min > $value) {
        //             $min = $value;
        //             $k   = $key;
        //         }
        //         $t++;
        //     }
        //     unset($arr[$k]);
        //     $aim_arr[] = $min;
        // }
        // echo $t."</br>";
        // var_dump($aim_arr);
        // var_dump($arr);
        // die();
        // 
        // 
        ###
        ###  case 2: 冒泡排列
        // //
        // //
        // //不断比较相邻两个元素的大小，并纠正顺序 复杂度=(n-1)*(n-1)
        
        // 交换次数比冒泡排序少多了，由于交换所需CPU时间比比较所需的CPU时间多，n值较小时，选择排序比冒泡排序快
        
        // $arr_count    = count($arr);
        // $tmp          = 0;
        // $t = 0;
        // for( $i = 1; $i < $arr_count; $i++){
        //     for( $j = 1; $j < $arr_count; $j++){
        //         if ($arr[$j-1]>$arr[$j]) {
        //             $tmp        = $arr[$j-1];
        //             $arr[$j-1]  = $arr[$j];
        //             $arr[$j]    = $tmp;
        //         }
        //         $t++;
        //     }
        // }
        // echo $t."</br>";
        // var_dump($arr);die();
        // 
        // 
        ###
        ## case 3: 快速排序
        // // 
        // // 设准值、两个指针，分别寻找数组中小于或大于准值的数
        // // 

        //// $arr_count  = count($arr);
        //// $home       = 0;
        //// $end        = $arr_count-1;
        //// //$arr = self::quickSort($arr,$home,$end);
        //// $result     = [
        ////     't'     =>0,
        ////     'arr'   =>$arr,
        //// ];
        //// $result = self::quickSortT1($result,$home,$end);
        //// var_dump($result);die();
        $arr = [2,4,5,6,3,1,9,7,8];
        //      0,1,2,3,4,5,6,7,8,
        $result = self::quickSortV1($arr);
        var_dump($result);die();
        
        ###
        ## case 4:插入排序
        // // 
        // // 令新成员插入到已有队列正确的位置
        // // 实现：将第一个元素作为已有队列，后面的元素作为新成员进行插入操作
        // // 
        // $arr = [2,4,5,6,3,9,343,32,1,45,5];
        // //$res_count = 0;    //新数列的最后一个元素的位置
        // $arr_count = count($arr);   //原数列的元素数量
        // for($i = 1;$i<$arr_count;$i++){    //i为新元素在数组中的位置
        //     $point       = $i;    //将i的值赋给point，为后面指针多次前移做准备
        //     $point_value = $arr[$i]; //将新元素的值赋给point_value，为后面交换做准备
        //     for($j = $i-1;$j >= 0 ;$j--){
        //     //for($j = $res_count;$j >= 0 && $res_count<=$arr_count;$j--){   //j表示新成员要对比的元素在新数组的位置

        //         if ($point_value < $arr[$j] ) {    // 比较
        //             $arr[$point] = $arr[$j];      // 当新元素较小时，令与新元素比较的元素后移
        //             $point--;                     // 指针前移
        //             $arr[$point] = $point_value;  // 让新元素取代 与新元素比较的元素 的原本位置
        //             // if ($j===0) {
        //             //     $res_count++;
        //             // }
        //         }else{         
        //                                          //当新元素大于做比较的元素时，新元素当前的位置就是他该呆的位置
        //             //$res_count++;                //新数列的最后一个值的位置加一
        //             break;                       //插入成功后退出第二层循环，准备插入下一个元素
        //         }

        //     }

        // }
        // var_dump($arr);
        // die();
        // // 
        // // 
        ###
        ## case 5:计数排序
        // // 
        // // 将待排数组按照值对应键的方式插入另外一个数组
        // // 
        // // 
        // $tmp = [];
        // $aim = [];
        // foreach ($arr as $key => $value) {
        //     if (isset($tmp[$value])) {
        //         $tmp[$value] ++;
        //     }else{
        //         $tmp[$value] = 1;
        //     }
        // }
        // ksort($tmp);
        // foreach ($tmp as $k => $v) {
        //     for($i=0;$i<$v;$i++){
        //         $aim[] = $k;
        //     }
        // }
        // var_dump($aim);die();
        // 
        //
        ###
        ## case 6: 
        // // 问题描述： 给定一个正整数集合S，S内的正整数都不相同并且无序。给定1个正整数K，求任意2个元素的和都不能被K整除的S的最大子集的元素个数。
        // // 举例： S=[2,3,4,5]，K=3时，S0=[2,3,4,5]中2+4和4+5都不满足；S1=[2,3,5]满足任意2个元素之和都不能被K=3整除，所以最大子集的元素个数是3；
        // // 输入： 集合S，可以理解为PHP的数组； 大于2的正整数K；
        // // 输出： integer
        // //
        // //取巧思路：余数为1 的不能和余数为2的在一起，余数为0的只能有一个。
        // //

        // $arr = [6,5,1,4,4];
        // $k=8;
        // // $map = [
        // //     '0' => 0,
        // //     '1' => 0,
        // //     '2' => 0,
        // // ];
        // $map = [];
        // for($i = 0; $i<$k;$i++){        //n
        //     $map[$i] = 0;
        // }

        // foreach ($arr as $key => $value) {  //n
        //     // $tmp = $value % 3;
        //     $tmp = $value %$k;
        //     $map[$tmp]++;
        // }
        // $max = 0;
        // for($i =1; $i<($k+1)/2;$i++) {   //  n/2
        //     if ($i == $k-$i) {
        //         if ($map[$i] !=0) {
        //             $max = $max + 1;
        //         }
        //         break;
        //     }
        //     if ($map[$i]>$map[$k-$i]) {
        //         $max = $map[$i] +$max;
        //     }else{
        //         $max = $map[$k-$i] +$max;
        //     }
        // }
        // // if ($map['1']>$map['2']) {
        // //     $max = $map['1'];
        // // }else{
        // //     $max = $map['2'];
        // // }
        // var_dump($map);
        // if ($map['0']!=0) {
        //     $max++;
        // }
        // echo "integer:  {$max}";
        //
        ###
        ###  case 7:
        // //
        // // 给定一个整数数组 nums 和一个目标值 target，请你在该数组中找出和为目标值的那 两个 整数，并返回他们的数组下标。

        // // 你可以假设每种输入只会对应一个答案。但是，你不能重复利用这个数组中同样的元素。

        // // 示例:

        // // 给定 nums = [2, 7, 11, 15], target = 9

        // // 因为 nums[0] + nums[1] = 2 + 7 = 9
        // // 所以返回 [0, 1]
        // // 
        // // 
        // $nums   = [2, 7, 11, 34,15,4,5];
        // $target = 9;

        // $tmp    =[];
        // $keys   = [];
        // foreach ($nums as $k => $v) {
        //     if (isset($tmp[$target-$v])) {
        //         $keys   = [$tmp[$target - $v],$k];
        //         break;
        //     //   $keys[] = [$tmp[$target-$v],$k];
        //     }else{
        //         $tmp[$v] = $k;
        //     }
        // }
        // return $keys;

    }

    public function quickSort($arr,$home,$end){

        $z  = $arr[$home];
        $zk = $home;

        $i  = $home+1;
        $j  = $end;
        if ($i == $j) {
            if ($arr[$zk]>$arr[$i]) {
                $arr[$zk]   = $arr[$i];
                $arr[$i]    = $z;
                return $arr;die();              
            }
        }
        while ($i!=$j) {
            for( ; $j!=$i && $j>=$home; $j--) {
                if ($arr[$j]<$z) {
                    $arr[$zk]   = $arr[$j];
                    $arr[$j]    = $z;
                    $zk         = $j;
                    break;
                }
            }
            for( ; $i!=$j && $i<=$end; $i++) {
                if ($arr[$i]>$z) {
                    $arr[$zk]   = $arr[$i];
                    $arr[$i]    = $z;
                    $zk         = $i;
                    break;
                }
            }
        }
        $home1  = $home;
        $end1   = $zk-1;
        $home2  = $zk+1;
        $end2   = $end;
        if ($end1-$home1 >=1) {
            $arr = self::quickSort($arr,$home1,$end1);
        }
        
        if ($end2-$home2 >=1) {
            $arr = self::quickSort($arr,$home2,$end2);
        }


        return $arr;
    }

    public function quickSortT1($result,$home,$end){

        $arr= $result['arr'];
        $t  = $result['t'];

        $z  = $arr[$home];
        $zk = $home;

        $i  = $home+1;
        $j  = $end;
        if ($i == $j) {
            if ($arr[$zk]>$arr[$i]) {
                $arr[$zk]   = $arr[$i];
                $arr[$i]    = $z;
                $t++;

                $result["arr"]  = $arr;
                $result['t']    = $t;
                return $result;die();              
            }
            $t++;
        }
        while ($i!=$j) {
            for( ; $j!=$i && $j>=$home; $j--) {
                if ($arr[$j]<$z) {
                    $arr[$zk]   = $arr[$j];
                    $arr[$j]    = $z;
                    $zk         = $j;
                    break;
                }
                $t++;
            }
            for( ; $i!=$j && $i<=$end; $i++) {
                if ($arr[$i]>$z) {
                    $arr[$zk]   = $arr[$i];
                    $arr[$i]    = $z;
                    $zk         = $i;
                    break;
                }
                $t++;
            }
            if ($t>2000) {
                die('error');
            }
        }
        $result['arr']  = $arr;
        $result['t']    = $t;
        $home1  = $home;
        $end1   = $zk-1;
        $home2  = $zk+1;
        $end2   = $end;
        if ($end1-$home1 >=1) {
            $result = self::quickSortV1($result,$home1,$end1);
        }
        
        if ($end2-$home2 >=1) {
            $result = self::quickSortV1($result,$home2,$end2);
        }


        return $result;
    }

    public function quickSortV1($arr){
        if (!is_array($arr)) {
            return false;
        }
        $count = count($arr);
        if ($count < 2) {
            return $arr;
        }
        $head   = array_shift($arr);
        $left   = [];
        $right  = [];
        foreach ($arr as $value) {
            if ($head > $value) {
                $left[]     = $value;
            }else{
                $right[]    = $value;
            }
        }
        $left_res   = self::quickSortV1($left);
        $left_res[] = $head;
        $right_res  = self::quickSortV1($right);
        $result     = array_merge($left_res,$right_res);
        return $result;
    }
}