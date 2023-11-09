<?php
namespace Artistro08\UserExtend\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class UserEmployeeFields extends Migration
{
    public function up()
    {
        if (Schema::hasColumns('users', ['position'])) {
            return;
        }

        Schema::table('users', function ($table) {
            $table->string('position')->nullable();
        });
    }

    public function down()
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function ($table) {
                $table->dropColumn(['position']);
            });
        }
    }
}
