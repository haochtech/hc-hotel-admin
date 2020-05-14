<?php
//if(!$_GET['longitude'] || !$_GET['latitude']) exit('-1');

// longitude 经度
// latitude 维度


 
class Convert{
    private $PI = 3.14159265358979324;
    private $x_pi = 0;
 
    public function __construct()
    {
        $this->x_pi = 3.14159265358979324 * 3000.0 / 180.0;
    }
 
    /**
     * 判断一个坐标是否在圆内
     * 思路：判断此点的经纬度到圆心的距离  然后和半径做比较
     * 如果此点刚好在圆上 则返回true
     * @param $point ['lng'=>'','lat'=>''] array指定点的坐标
     * @param $circle array ['center'=>['lng'=>'','lat'=>''],'radius'=>'']  中心点和半径
     */
    function is_point_in_circle($point, $circle){
 
        $distance = $this -> distance($point['lat'],$point['lng'],$circle['center']['lat'],$circle['center']['lng']);
        if($distance <= $circle['radius']){
            return true;
        }else{
            return false;
        }
    }
 
 
    /**
     *  计算两个点之间的距离
     * @param $latA  第一个点的纬度
     * @param $lonA  第一个点的经度
     * @param $latB  第二个点的纬度
     * @param $lonB  第二个点的经度
     * @return float
     */
    function distance($latA, $lonA, $latB, $lonB)
    {
        $earthR = 6371000.;
        $x = cos($latA * $this->PI / 180.) * cos($latB * $this->PI / 180.) * cos(($lonA - $lonB) * $this->PI / 180);
        $y = sin($latA * $this->PI / 180.) * sin($latB * $this->PI / 180.);
        $s = $x + $y;
        if ($s > 1) $s = 1;
        if ($s < -1) $s = -1;
        $alpha = acos($s);
        $distance = $alpha * $earthR;
        return $distance;
    }
 
 
    /**
     * 判断一个坐标是否在一个多边形内（由多个坐标围成的）
     * 基本思想是利用射线法，计算射线与多边形各边的交点，如果是偶数，则点在多边形外，否则
     * 在多边形内。还会考虑一些特殊情况，如点在多边形顶点上，点在多边形边上等特殊情况。
     * @param $point 指定点坐标
     * @param $pts 多边形坐标 顺时针方向
     */
    function is_point_in_polygon($point, $pts) {
        $N = count($pts);
        $boundOrVertex = true; //如果点位于多边形的顶点或边上，也算做点在多边形内，直接返回true
        $intersectCount = 0;//cross points count of x
        $precision = 2e-10; //浮点类型计算时候与0比较时候的容差
        $p1 = 0;//neighbour bound vertices
        $p2 = 0;
        $p = $point; //测试点
 
        $p1 = $pts[0];//left vertex
        for ($i = 1; $i <= $N; ++$i) {//check all rays
            // dump($p1);
            if ($p['lng'] == $p1['lng'] && $p['lat'] == $p1['lat']) {
                return $boundOrVertex;//p is an vertex
            }
 
            $p2 = $pts[$i % $N];//right vertex
            if ($p['lat'] < min($p1['lat'], $p2['lat']) || $p['lat'] > max($p1['lat'], $p2['lat'])) {//ray is outside of our interests
                $p1 = $p2;
                continue;//next ray left point
            }
 
            if ($p['lat'] > min($p1['lat'], $p2['lat']) && $p['lat'] < max($p1['lat'], $p2['lat'])) {//ray is crossing over by the algorithm (common part of)
                if($p['lng'] <= max($p1['lng'], $p2['lng'])){//x is before of ray
                    if ($p1['lat'] == $p2['lat'] && $p['lng'] >= min($p1['lng'], $p2['lng'])) {//overlies on a horizontal ray
                        return $boundOrVertex;
                    }
 
                    if ($p1['lng'] == $p2['lng']) {//ray is vertical
                        if ($p1['lng'] == $p['lng']) {//overlies on a vertical ray
                            return $boundOrVertex;
                        } else {//before ray
                            ++$intersectCount;
                        }
                    } else {//cross point on the left side
                        $xinters = ($p['lat'] - $p1['lat']) * ($p2['lng'] - $p1['lng']) / ($p2['lat'] - $p1['lat']) + $p1['lng'];//cross point of lng
                        if (abs($p['lng'] - $xinters) < $precision) {//overlies on a ray
                            return $boundOrVertex;
                        }
 
                        if ($p['lng'] < $xinters) {//before ray
                            ++$intersectCount;
                        }
                    }
                }
            } else {//special case when ray is crossing through the vertex
                if ($p['lat'] == $p2['lat'] && $p['lng'] <= $p2['lng']) {//p crossing over p2
                    $p3 = $pts[($i+1) % $N]; //next vertex
                    if ($p['lat'] >= min($p1['lat'], $p3['lat']) && $p['lat'] <= max($p1['lat'], $p3['lat'])) { //p.lat lies between p1.lat & p3.lat
                        ++$intersectCount;
                    } else {
                        $intersectCount += 2;
                    }
                }
            }
            $p1 = $p2;//next ray left point
        }
 
        if ($intersectCount % 2 == 0) {//偶数在多边形外
            return false;
        } else { //奇数在多边形内
            return true;
        }
    }
}
 

 
//$point = ['lng'=>$_GET['longitude'],'lat'=>$_GET['latitude']];

/*$circle = [
    'center'=>['lng'=>116.12637,'lat'=>40.114308],
    'radius'=>46807.83038795571
];*/
 
//$convert = new Convert();
//$bool = $convert -> is_point_in_circle($point,$circle);
//var_dump($bool);
 
/*$pts = [
    ['lng'=>108.326212, 'lat'=>22.891039],
    ['lng'=>108.274757, 'lat'=>22.890107],
    ['lng'=>108.22359, 'lat'=>22.856143],
	['lng'=>108.235304, 'lat'=>22.791654],
	['lng'=>108.247449, 'lat'=>22.769528],
	['lng'=>108.276697, 'lat'=>22.755665],
	['lng'=>108.323769, 'lat'=>22.754065],
	['lng'=>108.334189, 'lat'=>22.722067],
	['lng'=>108.390531, 'lat'=>22.7332],
	['lng'=>108.441986, 'lat'=>22.761664],
	['lng'=>108.497609, 'lat'=>22.787922],
	['lng'=>108.494375, 'lat'=>22.821637],
	['lng'=>108.446441, 'lat'=>22.819638],
	['lng'=>108.42711, 'lat'=>22.85128],
	['lng'=>108.375295, 'lat'=>22.878187],
	['lng'=>108.326217, 'lat'=>22.891035],
	['lng'=>108.326203, 'lat'=>22.891039],
	['lng'=>108.326203, 'lat'=>22.891039],
	['lng'=>108.326203, 'lat'=>22.891039]
];*/
 
//$point = ['lng'=>115.989864,'lat'=>39.973272];
//$bool = $convert -> is_point_in_polygon($point,$pts);
//var_dump($bool);