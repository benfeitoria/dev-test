<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Postagem;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$createdAt = date('Y-m-d H:i:s');
$texto     = <<<LOREM_IPSUM
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque dapibus justo id sollicitudin tempus. Integer ut varius erat. Vestibulum accumsan massa non luctus hendrerit. Vestibulum vel gravida velit. Suspendisse vitae lectus sed diam sagittis malesuada. Duis blandit orci ac arcu luctus tincidunt. Proin a lacinia mi, nec efficitur lacus. Maecenas feugiat metus sed elit aliquam aliquam. Duis quis diam faucibus, iaculis nisl quis, tempor neque.
Donec rhoncus diam nec massa ullamcorper facilisis. Morbi eros tortor, imperdiet eu euismod sit amet, ornare non erat. Suspendisse tincidunt et libero vestibulum molestie. Nam commodo ante in diam efficitur, in porttitor turpis tempor. Aenean tincidunt turpis a risus feugiat, hendrerit pharetra odio ultrices. Vivamus gravida feugiat lectus nec gravida. Praesent vehicula, nulla eu accumsan efficitur, nisl turpis tristique risus, eu ornare urna ipsum ac ipsum. Nam iaculis urna quis tellus auctor, quis iaculis enim commodo. Integer sed ligula condimentum, consectetur turpis sed, sagittis erat. Vivamus varius tempor dapibus. Donec cursus sem nisl. Quisque aliquet nisi nec dolor posuere porta. Sed eleifend sagittis scelerisque. Ut blandit leo nisi, nec gravida nisl facilisis vitae.
Donec egestas consequat libero, ut mollis magna tempus ac. Aenean ultrices tincidunt lectus, non malesuada arcu dictum ut. Aliquam imperdiet est risus, sit amet laoreet felis semper vitae. Etiam tincidunt libero nibh, sit amet varius nunc hendrerit euismod. Nam at justo at ante scelerisque malesuada vitae a velit. Aliquam laoreet, purus ut interdum varius, odio orci ultricies purus, sed eleifend velit mi vel libero. Cras lobortis est ut enim pulvinar, quis rhoncus augue sagittis. Aliquam suscipit auctor sem ut molestie. Curabitur viverra leo ac venenatis molestie. Morbi mattis, quam id egestas ornare, odio sapien vehicula enim, nec efficitur leo nisi sed velit.
Aenean consequat diam ut consectetur commodo. Nulla est dui, vestibulum vel mauris nec, tempor condimentum sem. Nam sit amet venenatis mi. Integer consequat ex nibh, eu ultrices ante porttitor nec. Fusce a dignissim tortor. Nulla in sem nec tellus molestie aliquam. Sed ac ante tellus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque ultricies elementum eros vitae eleifend. Ut erat justo, lobortis nec pharetra et, lobortis ac sem. Etiam vitae felis condimentum, blandit mi sit amet, porttitor urna. Nunc mauris sapien, rutrum non bibendum et, cursus vitae diam. Aliquam at risus arcu.
Proin elementum viverra commodo. Vestibulum iaculis felis at purus feugiat molestie. Nam sit amet rhoncus massa. Duis pulvinar vitae neque vel euismod. Proin id lorem ante. Sed ornare, metus et tincidunt aliquam, lacus lacus tristique arcu, id aliquet est tortor vitae diam. In vehicula, arcu eu finibus lacinia, nunc nulla faucibus lectus, et congue nulla tellus et mauris. Duis hendrerit, eros vel maximus tempor, magna tellus egestas ipsum, eu semper eros ipsum vel risus. Pellentesque quis magna nec metus bibendum sagittis quis et ante. Phasellus blandit ipsum at dui bibendum tristique. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ut mauris tempus, tristique justo vel, eleifend diam. In blandit velit eros, quis volutpat dui porta eget. Ut convallis rutrum risus ut tristique. Duis vel elementum lectus. Donec eget augue molestie, pharetra nulla cursus, condimentum quam. 
LOREM_IPSUM;

$factory->define(Postagem::class, function (Faker $faker) use ($texto, $createdAt) {
    return [
        'imagem'       => 'https://picsum.photos/2000/1500/?random=1',
        'titulo'       => Str::random(10) .' '. Str::random(2) .' '. Str::random(10),
        'texto'        => $texto,
        'created_at'   => $createdAt,
        'categoria_id' => $faker->numberBetween(1, 5),
        'autor_id'     => $faker->numberBetween(1, 2),
    ];
});
