<?php
# 工厂模式
# 定义一个用于创建对象的接口
# 让子类决定实例化哪一类
# 使用一个类的实例化延迟到子类
	# 接口
    interface abstracted{
        public function realCreate();
    }
    # 女人类
    class Woman{
        public function action(){
            echo 'this is woman';
        }
    }
    # 男人类
    class Man{
        public function action(){
            echo 'this is man';
        }
    }
    # 创建女人
    class WomanCreator implements abstracted {
        public $chromosome;//染色体
        public function realCreate(){
            if ($this->chromosome == "xx") {
                return new Woman();
            }
        }
    }
    # 创建男人
    class ManCreator implements abstracted {
        public $chromosome;
        public function realCreate(){
            if ($this->chromosome == "xy" || $this->chromosome == "xyy") {
                return new Man();
            }
        }
    }
    # 人类工厂
    class PersonFactory{
        public function create($what){
            $create = $what."Creator";
            return $create = new $create();
        }
    }

    # 测试
    $create = new PersonFactory();
    $instance = $create->create('Man');
    $instance->chromosome = "xy";
    $instance->realCreate()->action();
?>