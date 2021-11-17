# excel
php artisan make:scaffold ExcelDemo --schema="str_column:string(255):default(''):comment('字符串字段'),int_column:integer(false,true):default(0):comment('整数字段'),float_column:decimal(8,2,false):default(0):comment('浮点数字段'),pic_column:string(255):default(''):comment('图片字段'),text_column:text:nullable:comment('文本字段')" --comment="excel demo"
