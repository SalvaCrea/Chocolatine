<?php
namespace salva_powa;

class sp_model
{
    /**
     * [$name the name of the model]
     * @var [string]
     */
    var $name;
    /**
     * [$description the descrption of the model]
     * @var [string]
     */
    var $description;
    /**
     * [$slug the unique name of the model]
     * @var [string]
     */
    var $slug;
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
    public function model()
    {
      return false;
    }
    public function save()
    {
      return false;
    }

}
