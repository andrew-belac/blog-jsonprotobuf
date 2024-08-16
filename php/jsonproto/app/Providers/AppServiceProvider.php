<?php

namespace App\Providers;


use App\Benchmark\CarbonDateTimeNormalizer;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\BackedEnumNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\JsonSerializableNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\UidNormalizer;
use Symfony\Component\Serializer\Serializer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        app()->scoped(Serializer::class, function(){
            $reflectionExtractor = new ReflectionExtractor();
            $propertyTypeExtractor = new PropertyInfoExtractor([$reflectionExtractor], [$reflectionExtractor], [], [$reflectionExtractor], [$reflectionExtractor]);



            $encoders = [new JsonEncoder()];
            $normalizers = [
                new ArrayDenormalizer(),
                new UidNormalizer(),
                new DateTimeNormalizer(),
                new CarbonDateTimeNormalizer(),
                new BackedEnumNormalizer(),
                new JsonSerializableNormalizer(),
                new ObjectNormalizer(null, null, null, $propertyTypeExtractor),
            ];

            return new Serializer($normalizers, $encoders);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
