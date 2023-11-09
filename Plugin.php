<?php namespace Artistro08\UserExtend;

use Backend;
use Yaml;
use File;
use System\Classes\PluginBase;
use RainLab\User\Controllers\Users as UsersController;
use RainLab\User\Models\User as UserModel;

/**
 * Plugin Information File
 *
 * @link https://docs.octobercms.com/3.x/extend/system/plugins.html
 */
class Plugin extends PluginBase
{

    protected function extendUsersController()
    {
        UsersController::extendFormFields(function ($widget) {
            // Prevent extending of related form instead of the intended User form
            if (! $widget->model instanceof UserModel) {
                return;
            }

            $configFile = plugins_path('artistro08/userextend/config/employee_fields.yaml');
            $config     = Yaml::parse(File::get($configFile));
            $widget->addTabFields($config);
        });
    }

    protected function extendUserModel()
    {
        UserModel::extend(function ($model) {
            $model->addFillable([
                'position',
            ]);
        });
    }
    
    /**
     * pluginDetails about this plugin.
     */
    public function pluginDetails()
    {
        return [
            'name' => 'UserExtend',
            'description' => 'Extends User plugin for Tailor and offers User fields',
            'author' => 'Artistro08',
            'icon' => 'icon-user-o'
        ];
    }

    /**
     * register method, called when the plugin is first registered.
     */
    public function register()
    {
        //
    }

    /**
     * boot method, called right before the request route.
     */
    public function boot()
    {
        $this->extendUserModel();
        $this->extendUsersController();
    }

    /**
     * registerComponents used by the frontend.
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Artistro08\UserExtend\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * registerPermissions used by the backend.
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'artistro08.userextend.some_permission' => [
                'tab' => 'UserExtend',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * registerNavigation used by the backend.
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'userextend' => [
                'label' => 'UserExtend',
                'url' => Backend::url('artistro08/userextend/mycontroller'),
                'icon' => 'icon-leaf',
                'permissions' => ['artistro08.userextend.*'],
                'order' => 500,
            ],
        ];
    }

    public function registerContentFields()
    {
        return [
            \Artistro08\UserExtend\ContentFields\UserRelation::class => 'userrelation',
        ];
    }
}
