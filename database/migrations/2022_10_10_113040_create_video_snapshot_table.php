<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoSnapshotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_snapshot', function (Blueprint $table) {
            $table->unsignedBigInteger('video_id')->index();
            $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade');
            $table->unsignedBigInteger('snapshot_id')->index();
            $table->foreign('snapshot_id')->references('id')->on('snapshots')->onDelete('cascade');
            $table->primary(['video_id', 'snapshot_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_snapshot');
    }
}
