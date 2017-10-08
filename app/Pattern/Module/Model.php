<?php
namespace sp_framework\Pattern\Module;

class Model
{
    /**
     * [$name the name of the model]
     * @var [string]
     */
    var $name = __CLASS__;
    /**
     * [$description the descrption of the model]
     * @var [string]
     */
    var $description;
    /**
     * [$type the type of the model]
     * list of the model possible
     * [ simple, self, post_type ]
     * @var [string]
     */
    var $type;
    /**
     * [$model containe the schema of data ]
     * @var [array]
     */
    var $model;
    /**
     * Use for get the schema form
     */
    public function get_model()
    {
      return false;
    }
    public function save()
    {
      return false;
    }

}
