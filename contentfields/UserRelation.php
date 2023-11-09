<?php namespace Artistro08\UserExtend\ContentFields;

use RainLab\User\Models\User;
use Tailor\Classes\ContentFieldBase;
use October\Contracts\Element\FormElement;
use October\Contracts\Element\ListElement;
use October\Contracts\Element\FilterElement;

/**
 * UserRelation Content Field
 *
 * @link https://docs.octobercms.com/3.x/extend/tailor-fields.html
 */
class UserRelation extends ContentFieldBase
{
    /**
     * defineFormField will define how a field is displayed in a form.
     */
    public function defineFormField(FormElement $form, $context = null)
    {
        $form->addFormField($this->fieldName, $this->label)->useConfig($this->config)->displayAs('recordfinder');
    }

    /**
     * defineListColumn will define how a field is displayed in a list.
     */
    public function defineListColumn(ListElement $list, $context = null)
    {
        $list->defineColumn($this->fieldName, $this->label)->displayAs('partial')->useConfig([
            'path' => plugins_path('artistro08/userextend/contentfields/userrelation/partials/_user.htm'),
        ]);
    }

    /**
     * defineFilterScope will define how a field is displayed in a filter.
     */
    

    /**
     * extendModelObject will extend the record model.
     */
    public function extendModelObject($model)
    {
        $model->belongsTo[$this->fieldName] = User::class;
    }

    /**
     * extendDatabaseTable adds any required columns to the database.
     */
    public function extendDatabaseTable($table)
    {
        $table->mediumText($this->fieldName . '_id')->nullable();
    }
}
