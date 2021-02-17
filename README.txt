插入
$data = array('user_name'=>'tongji','user_pwd'=>'d6ceebf494d774931e92e45f834d490f','user_md5'=>'21232f297a57a5a743894a0e4a801fc3','user_lock'=>'d6ceebf494d774931e92e45f834d490f','user_email'=>'10010@qq.com','user_ip'=>'127.0.0.1','user_logintime'=>1311954804);
$dbData = Api::coms()->getDB()->insert('user',$data);

SELECT JOIN 用法说明
$option = array('user.user_name','=','admin.admin_name');
$dbData = Api::coms()->getDB()
->field('user.user_id,admin.admin_id')
->join(array('LEFT','admin',$option))
->where(array('user_name'=>'admin','admin_ip'=>'127.0.0.1'))
->order('user_id desc,user_logintime asc')
->limit(1,2)
->select('user');

SQL:: SELECT user.user_id,admin.admin_id FROM info_user AS user LEFT JOIN info_admin AS admin ON user.user_name=admin.admin_name WHERE (`user_name`='admin') AND (`admin_ip`='127.0.0.1') ORDER BY user_id desc,user_logintime asc LIMIT 0,2 

UPDATE JOIN 用法说明
$option = array('user.user_name','=','admin.admin_name');
$dbData = Api::coms()->getDB()
->join(array('LEFT','admin',$option))
->where(array('user_name'=>'admin'))
->update('user',array('user_email'=>'100000@qq.com','user_ip'=>'127.0.0.1',array('admin',array('admin_email'=>'100000@qq.com','admin_ip'=>'127.0.0.1'))));

SQL:: UPDATE info_user AS user LEFT JOIN info_admin AS admin ON user.user_name=admin.admin_name SET `user_email`="admin@qq.com",`user_ip`="127.0.0.1",`admin_email`="admin@qq.com",`admin_ip`="127.0.0.1" WHERE (`user_name`='admin') 

DELETE JOIN 用法说明
$option = array('user.user_name','=','admin.admin_name');
$dbData = Api::coms()->getDB()
->field('user,admin')
->join(array('LEFT','admin',$option))
->where(array('user_name'=>'admin','admin_name'=>'admin'))
->delete('user');

SQL:: DELETE `user`,`admin` FROM info_user AS user LEFT JOIN info_admin AS admin ON user.user_name=admin.admin_name WHERE (`user_name`='admin') AND (`admin_name`='admin') 

INNER JOIN 关键字在表中存在至少一个匹配时返回行。
LEFT JOIN 关键字从左表（table1）返回所有的行，即使右表（table2）中没有匹配。如果右表中没有匹配，则结果为 NULL。
RIGHT JOIN 关键字从右表（table2）返回所有的行，即使左表（table1）中没有匹配。如果左表中没有匹配，则结果为 NULL。
FULL OUTER JOIN 关键字只要左表（table1）和右表（table2）其中一个表中存在匹配，则返回行。FULL OUTER JOIN 关键字结合了 LEFT JOIN 和 RIGHT JOIN 的结果。

SELECT 用法说明
$dbData = Api::coms()->getDB()
->field(array('sid','aa','bbc'))
->order(array('sid'=>'desc','aa'=>'asc'))
->where(array('sid'=>"101",'aa'=>array('123455','>','or')))
->limit(1,2)
->select('t_table');

上语句等同下语句

$dbData = Api::coms()->getDB()
->field('sid,aa,bbc')
->order('sid desc,aa asc')
->where('sid=101 or aa>123455')
->limit(1,2)
->select('t_table');

$option = array('user_name'=>'admin');
$dbData = Api::coms()->getDB()
->field('user_id,user_name,user_logintime')
->order('user_id desc,user_logintime asc')
->where($option)
->limit(1,2)
->select('user');

给一个字段数字加一个值
Api::coms()->getDB()
->where(array('user_id' => '2'))
->update('user', array('count' => '(count+1)'));

SQL:: UPDATE info_user AS user SET `count`=(count+1) WHERE (`user_id`='2') 

获取最后执行的sql语句
$dbData = Api::coms()->getDB()->getLastSql();

直接执行sql语句
$option = "show tables";
$dbData = Api::coms()->getDB()->doSql($sql);

事务
$dbData = Api::coms()->getDB()->startTrans();
$dbData = Api::coms()->getDB()->where(array('user_name'=>'user'))->update('user',array('user_face'=>'测试一下'));
$dbData = Api::coms()->getDB()->where(array('user_name'=>'tongji'))->delete('user');
$dbData = Api::coms()->getDB()->commit();
