<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
// 
error_reporting(E_ALL ^ E_NOTICE);
//导出表格 导数据

function exportExcel($data, $savefile = null, $title = null, $sheetname = 'sheet1') {
	//import("ORG.Util.PHPExcel");
	import('PHPExcel',EXTEND_PATH);
	//若没有指定文件名则为当前时间戳
	if (is_null($savefile)) {
		$savefile = time();
	}
	//若指字了excel表头，则把表单追加到正文内容前面去
	if (is_array($title)) {
		array_unshift($data, $title);
	}
	$objPHPExcel = new PHPExcel();
	//Excel内容
	$head_num = count($title);

	foreach ($data as $k => $v) {
		$obj = $objPHPExcel->setActiveSheetIndex(0);
		$row = $k + 1; //行
		$nn = 0;

		foreach ($v as $vv) {
			$col = chr(65 + $nn); //列
			$obj->setCellValue($col . $row, $vv); //列,行,值
			$nn++;
		}
	}
	//设置列头标题
	for ($i = 0; $i < $head_num - 1; $i++) {
		$alpha = chr(65 + $i);
		$objPHPExcel->getActiveSheet()->getColumnDimension($alpha)->setAutoSize(true); //单元宽度自适应
		$objPHPExcel->getActiveSheet()->getStyle($alpha . '1')->getFont()->setName("Candara");  //设置字体
		$objPHPExcel->getActiveSheet()->getStyle($alpha . '1')->getFont()->setSize(12);  //设置大小
		$objPHPExcel->getActiveSheet()->getStyle($alpha . '1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLACK); //设置颜色
		$objPHPExcel->getActiveSheet()->getStyle($alpha . '1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平居中
		$objPHPExcel->getActiveSheet()->getStyle($alpha . '1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直居中
		$objPHPExcel->getActiveSheet()->getStyle($alpha . '1')->getFont()->setBold(true); //加粗
	}

	$objPHPExcel->getActiveSheet()->setTitle($sheetname); //题目
	$objPHPExcel->setActiveSheetIndex(0); //设置当前的sheet
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="' . $savefile . '.xls"');//文件名称
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); //Excel5
	$objWriter->save('php://output');
}

/**
 *  生成二维码
 * function qrcode(){
 *     $filename='qrcode.png';
 *     $logo=SITE_PATH."\\Public\\Home\\images\\logo_80.png";
 *     qrcode('http://www.dellidc.com',$filename,false,$logo,8,'L',2,true);
 * }
 *
 * @param $data 二维码包含的文字内容
 * @param $filename 保存二维码输出的文件名称，*.png
 * @param bool $picPath 二维码输出的路径
 * @param bool $logo 二维码中包含的LOGO图片路径
 * @param string $size 二维码的大小
 * @param string $level 二维码编码纠错级别：L、M、Q、H
 * @param int $padding 二维码边框的间距
 * @param bool $saveandprint 是否保存到文件并在浏览器直接输出，true:同时保存和输出，false:只保存文件
 * return string
 */
function qrcode($data='',$filename='',$picPath=false,$logo=false,$size='10',$level='L',$padding=2,$saveandprint=false){
   // vendor("phpqrcode.phpqrcode");//引入工具包
    import('Phpqrcode.phpqrcode',EXTEND_PATH);
    // 下面注释了把二维码图片保存到本地的代码,如果要保存图片,用$fileName替换第二个参数false
    $path = $picPath?$picPath:ROOT_PATH."\\public\\uploads\\QRcode"; //图片输出路径
    //halt($path);
    if(!file_exists($path)){

		mkdir($path);
    }
    //在二维码上面添加LOGO
    if(empty($logo) || $logo=== false) { //不包含LOGO
        if ($filename==false) {
            QRcode::png($data, false, $level, $size, $padding, $saveandprint); //直接输出到浏览器，不含LOGO
        }else{
            $filename=$path.'/'.$filename; //合成路径
            QRcode::png($data, $filename, $level, $size, $padding, $saveandprint); //直接输出到浏览器，不含LOGO
        }
    }else { //包含LOGO
        if ($filename==false){
            //$filename=tempnam('','').'.png';//生成临时文件
           die('参数错误');
        }else {
            //生成二维码,保存到文件
            $filename = $path . '\\' . $filename; //合成路径
        }
        QRcode::png($data, $filename, $level, $size, $padding);
        $QR = imagecreatefromstring(file_get_contents($filename));
        $logo = imagecreatefromstring(file_get_contents($logo));
        $QR_width = imagesx($QR);
        $QR_height = imagesy($QR);
        $logo_width = imagesx($logo);
        $logo_height = imagesy($logo);
        $logo_qr_width = $QR_width / 5;
        $scale = $logo_width / $logo_qr_width;
        $logo_qr_height = $logo_height / $scale;
        $from_width = ($QR_width - $logo_qr_width) / 2;
        imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
        if ($filename === false) {
            Header("Content-type: image/png");
            imagepng($QR);
        } else {
            if ($saveandprint === true) {
                imagepng($QR, $filename);
                header("Content-type: image/png");//输出到浏览器
                imagepng($QR);
            } else {
                imagepng($QR, $filename);
            }
        }
    }
    return $filename;
}
//生产二维码图片
 function scQRcode($id){
	import('Phpqrcode.phpqrcode',EXTEND_PATH);//引入工具包
	
	//$value = 'http://geidco.95598bj.net/index/files/show/id/'.$id; //二维码内容
	$value = 'https://xcx.isu5.com/index/Files/show/id/'.$id; //二维码内容
	$errorCorrectionLevel = 'Q';//容错级别
	$matrixPointSize = 10;//生成图片大小
	
	//生成二维码图片
	QRcode::png($value, './uploads/QRcode/qrcode.png', $errorCorrectionLevel, $matrixPointSize, 2);
	
	
	$logo = './uploads/QRcode/logo.png';//准备好的logo图片
	$QR = './uploads/QRcode/qrcode.png';//已经生成的原始二维码图
	if ($logo !== FALSE) {
		$QR = imagecreatefromstring(file_get_contents($QR));
		$logo = imagecreatefromstring(file_get_contents($logo));
		$QR_width = imagesx($QR);//二维码图片宽度
		$QR_height = imagesy($QR);//二维码图片高度
		$logo_width = imagesx($logo);//logo图片宽度
		$logo_height = imagesy($logo);//logo图片高度
		$logo_qr_width = $QR_width / 5;
		$scale = $logo_width/$logo_qr_width;
		$logo_qr_height = $logo_height/$scale;
		$from_width = ($QR_width - $logo_qr_width) / 2;
		//重新组合图片并调整大小
		imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,
		$logo_qr_height, $logo_width, $logo_height);
	}
	//输出图片
	//$userid = uniqid(rand(10000,99999));
	//$filename = './uploads/QRcode/user/'.$userid.'_'.$id.'.png';
	$filename = './uploads/QRcode/user/'.$id.'.png';
	
	imagepng($QR, $filename);
	return $filename;
}