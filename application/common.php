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