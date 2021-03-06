## SQL集合

### 符号解释
* `{}` 内容替换, `{table_name}` 使用时将 table_name 换成自己的表名
* `[]` 表示可省, `[{index_name}]` index_name 非必需内容, 可以省略
* `[{[|]}]` 表示可省, `|` 分割多个选项, 内层 `[]`表示多个选项,`[{index_type[fulltext|unique]}]`

#### 添加索引 `索引添加和删除受权限限制,create > alter,具体使用什么语法可以根据权限来使用`
语法
```
alter table {table_name} 
add 
[{index_type[fulltext|normal(默认,不需要写,会有语法错误)|spatial|unique]}] index 
[`{index_name}`] 
(`{column}`,`{column}`)
[USING [BTREE|HASH]] [COMMENT 'remark'];

create index admin_email_index
	on admin (email);
```

示例, test_normal_key 和 user_id 要用 ` 引起来
```
alter table test
add [unique] index [`test_normal_key`] (`user_id`)  
[using btree] 
[comment '为test表添加索引,索引类型为normal,索引名称为test_normal_key,索引字段为user_id,索引方法为btree,这个是备注'];
```

key `主键只能作用于一个列上，添加主键索引时，需要确保该主键默认不为空（NOT NULL）`
```
alter table {table_name}
add primary key ({column});
```

顺序
~~~
索引类型 fulltext(全文索引)|normal(普通索引)|spatial|unique(唯一索引,应当避免 Null 值)
索引名称 索引字段 索引方法 备注
~~~

###### 普通索引 
```
alter table {table_name} add index [{index_name}] ({column});
```

###### 组合索引
```
alter table {table_name} add index [{index_name}] ({column},{column});
```

###### 显示索引
```
show index from {table_name}
```

###### 删除索引
```
drop index `{index_name}` on {table_name}

alter table {table_name} drop index `{index_name}` ;
```

#### 强制使用索引
```
#语法: force index(`索引名称`)
#位置: from table 之后
select name from table force index(`PRIMARY`) where user_id = 1 and id = 1 ;
```

#### 更改表,字段的字符集
```
#更改表 
# char e c ter  字符
# ˈkar,i,k,tər
alter table {table_name} character set = {uft8 | utf8mb4};

#更改表字段
alter table {table_name}
modify column `{column_name}` varchar(80) character set utf8mb4 not null default '' after `{在column_name之前的字段}`;
```