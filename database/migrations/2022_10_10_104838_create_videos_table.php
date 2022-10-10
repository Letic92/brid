<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image');
            $table->string('thumbnail')->nullable();
            $table->integer('duration')->nullable();
            $table->timestamp('publish');
            $table->string('mime_type')->nullable();
            $table->boolean('monetize');
            $table->integer('age_gate_id');
            $table->string('webp')->nullable();
            $table->boolean('live_stream');
            $table->boolean('live_image');
            $table->boolean('video_background');
            $table->boolean('is_360');
            $table->string('credits')->nullable();
            $table->string('carousel_click_through_url')->nullable();
            $table->string('thumb')->nullable();
            $table->text('tags')->nullable();
            $table->integer('likes')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
