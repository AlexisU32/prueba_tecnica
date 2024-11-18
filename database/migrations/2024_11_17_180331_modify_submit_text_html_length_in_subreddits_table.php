<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('subreddits', function (Blueprint $table) {
        $table->text('submit_text_html')->change();
    });
}

public function down()
{
    Schema::table('subreddits', function (Blueprint $table) {
        $table->string('submit_text_html', 255)->change();
    });
}
};
