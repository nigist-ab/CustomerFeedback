Schema::create('feedbacks', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Ensure this is set up correctly
    $table->foreignId('survey_id')->nullable()->constrained()->onDelete('cascade');
    $table->text('message');
    $table->integer('rating')->nullable();
    $table->timestamps();
});
