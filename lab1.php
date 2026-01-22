<?php
                               
                               #  أولاً: دوال المصفوفات
$name ="دوال المصفوفات";
echo($name);  
echo "<br/>";                             
#إنشاء مصفوفة

$arr = array(1, 2, 3);

# تغيير حالة مفاتيح المصفوفة
$arr = ["Name"=>"abdulmajeed", "CITY"=>"Taiz"];
print_r(array_change_key_case($arr, CASE_LOWER));


echo '<br/>';


#  تقسيم المصفوفة إلى أجزاء

$arr = [1,2,3,4,5];
print_r(array_chunk($arr, 2));

echo '<br/>';

# دمج مفتاح من مصفوفة وقيم من مصفوفة أخرى
$keys = ["name","age"];
$values = ["abdulmajeed", 23];
print_r(array_combine($keys, $values));

echo "<br/>";

# إنشاء مصفوفة بقيم متكررة
print_r(array_fill(0, 4, "X"));
echo "<br/>";

# مل المفاتيح بقيمة واحدة

print_r(array_fill_keys(["a","b"], 100));

echo "<br/>";
                              #. دوال البحث داخل المصفوفات
 
# التحقق من وجود قيمة
echo in_array(3, [1,2,3]) ? "YES" : "NO";

echo"<br/>";

# إيجاد مفتاح عنصر

echo array_search("Ali", ["name"=>"Ali"]);
echo"<br/>";

#التحقق من وجود مفتاح.

$arr = ["name"=>"Ali"];
echo array_key_exists("name", $arr);
echo"<br/>";

                              # دوال فرز المصفوفات
 
#ترتيب تصاعدي.

$a = [3,1,2];
print_r(sort($a));                              
#echo"<br/>";

#ترتيب تنازلي.
print_r (rsort($a));

# ترتيب حسب القيم مع الحفاظ على المفاتيح.

$a = ["b"=>2,"a"=>1];
print_r (asort($a));
echo "<br/>";

# ترتيب حسب المفاتيح.

print_r (ksort($a));
echo "<br/>";

# خلط المصفوفة عشوائياً.

print_r (shuffle($a));
echo "<br/>";

                            #دوال الإضافة والحذف 

# إضافة عناصر في نهاية المصفوفة.

$a = [1,2];
print_r (array_push($a, 3));
 echo "<br/>";

#إضافة عناصر في نهاية المصفوفة.

$a = [1,2];
print_r (array_push($a, 3));
echo "<br/>";

# حذف آخر عنصر.
print_r (array_pop($a));
echo "<br/>";

#حذف أول عنصر.
print_r(array_shift($a));
echo "<br/>";

#إضافة عناصر في بداية المصفوفة.

print_r( array_unshift($a, 0));
echo "<br/>";

                            # دوال التجميع والحساب

# جمع عناصر المصفوفة.
echo array_sum([1,2,3]);
echo "<br/>";
#حاصل ضرب العناصر.
echo array_product([2,3,4]);
echo "<br/>";
                            #دوال المقارنة
# القيم الموجودة بمصفوفة وغير موجودة بالأخرى.
print_r(array_diff([1,2,3], [2,3]));
echo "<br/>";

# القيم المشتركة.
print_r(array_intersect([1,2,3], [2,3,4]));
echo "<br/>";

                            #دوال المفاتيح والقيم
#array_keys()
print_r(array_keys(["a"=>1,"b"=>2]));
echo "<br/>";

#array_values()
print_r(array_values(["a"=>1,"b"=>2]));
echo "<br/>";

#array_flip()
print_r(array_flip(["a"=>1,"b"=>2]));
echo "<br/>";

                            #دوال الدمج

# array_merge()
print_r(array_merge([1,2], [3,4]));                            
echo "<br/>";

#array_merge_recursive()
print_r(array_merge_recursive(["a"=>1], ["a"=>2]));
echo "<br/>";

# array_replace()
print_r(array_replace(["a"=>1], ["a"=>100]));
echo "<br/>";

                        # دوال التصفية والتحويل

#array_map()
print_r(array_map(fn($x) => $x * 2, [1,2,3]));                        
echo "<br/>";

# array_filter()
print_r(array_filter([1,2,3,4], fn($x)=>$x>2));
echo "<br/>";

#array_reduce()
echo array_reduce([1,2,3], fn($c,$i)=>$c+$i);
echo "<br/>";

                        # أخرى مهمة
#array_reverse()
print_r(array_reverse([1,2,3]));
echo "<br/>";

# array_unique()
print_r(array_unique([1,1,2,3]));
echo "<br/>";

# count()
echo count([1,2,3,4]);
echo "<br/>";

                                # ثانياً: دوال النصوص

$name =" دوال النصوص" ;
echo ($name);                               
echo "<br/>";

#الطول والبحث

# طول النص.

echo strlen("Hello");
echo "<br/>";

# إيجاد موضع جزء من النص.
echo strpos("Hello World", "World");
echo "<br/>";

# آخر ظهور.
echo strrpos("Hello Hello", "Hello");
echo "<br/>";

                    # التعديل والاستبدال  
# str_replace()
echo str_replace("world", "PHP", "Hello world");
echo "<br/>";

# substr()
echo substr("Hello", 1, 3);
echo "<br/>";

# trim()
echo trim("  hi  ");
echo "<br/>";

#ltrim() / rtrim()
echo ltrim("  hi");
echo rtrim("hi  ");
echo "<br/>";

                    #تغيير الحالة
# strtoupper()
echo strtoupper("hello");
echo "<br/>";

# strtolower()
echo strtolower("HELLO");
echo "<br/>";

# ucfirst()
echo ucfirst("hello world");
echo "<br/>";

# ucwords()
echo ucwords("hello world");
echo "<br/>";


                    # التقسيم والدمج
# explode()
print_r(explode(",", "a,b,c"));
echo "<br/>";

# implode()
echo implode("-", ["a","b","c"]);
echo "<br/>";

                   #المقارنة
# strcmp()
echo strcmp("a", "b");
echo"<br/>";

# strcasecmp()
echo strcasecmp("hello", "HELLO");
echo"<br/>";

                    # دوال الترميز
# md5()
echo md5("test");
echo"<br/>";

# sha1()
echo sha1("test");
echo"<br/>";

# htmlspecialchars()
echo htmlspecialchars("<b>Hello</b>");
echo"<br/>";

                    # أخرى مهمة
# str_repeat()
echo str_repeat("Hi ", 3);
echo"<br/>";

# strrev()
echo strrev("Hello");
echo "<br/>";

# number_format()
echo number_format(12345.6789, 3);
echo"<br/>";
?>