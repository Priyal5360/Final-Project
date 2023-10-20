<?php
$template_arr=array(
	array(
		'id'=>'template1',
		'title'=>__('Basic - 1', 'print-invoices-packing-slip-labels-for-woocommerce'),
		'preview_img'=>'template1.png',
	),
	array(
		'id'=>'template2',
		'title'=>__('Basic - 2', 'print-invoices-packing-slip-labels-for-woocommerce'),
		'preview_img'=>'template2.png',
	),
	array(
		'id'=>'template3',
		'title'=>__('Basic - 3', 'print-invoices-packing-slip-labels-for-woocommerce'),
		'preview_img'=>'template3.png',
	),
);

$template_arr = apply_filters("wt_pklist_add_pro_templates",$template_arr,$this->to_customize);