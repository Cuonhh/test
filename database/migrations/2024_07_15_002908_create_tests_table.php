<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('xxxx');
            $table->integer('qqqq');
            $table->float('kkkk');
            $table->time('eeee');
            $table->date('rrrr');
            $table->dateTime('tttt');
            $table->text('yyyy');
            $table->mediumText('uuuu');
            $table->longText('iiii');
            $table->unsignedBigInteger('bbbb');
            $table->unsignedDouble('pppp')->nullable();
            $table->boolean('oooo')->nullable()->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
