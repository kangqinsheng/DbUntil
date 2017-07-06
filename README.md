# DbUntil
## 数据库连接类，以及分页方法，通用查询
```
namespace model\DbUntil
class DbUntil{
    public function search();
    /**
     * 通用的增删改方法
     * sql代表传进来的sql语句
     */
    public function addDelUpd();
    /**
     * 通用的分页方法
     * $sql代表传入的sql语句
     * $cur_page代表从那一页开始
     * $rows代表查多少条
     * @author kqs
     * 
     */
    public function TongFen()
    ...

}
```
