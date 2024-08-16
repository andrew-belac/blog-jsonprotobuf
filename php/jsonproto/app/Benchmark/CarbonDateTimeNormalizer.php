<?php

namespace App\Benchmark;


use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Symfony\Component\PropertyInfo\Type;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\NotNormalizableValueException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;


final class CarbonDateTimeNormalizer implements NormalizerInterface, DenormalizerInterface
{
    public const FORMAT_KEY = 'datetime_format';
    public const TIMEZONE_KEY = 'datetime_timezone';
    public const CAST_KEY = 'datetime_cast';

    private array $defaultContext = [
        self::FORMAT_KEY => CarbonImmutable::RFC3339,
        self::TIMEZONE_KEY => null,
        self::CAST_KEY => null,
    ];

    private const SUPPORTED_TYPES = [
        CarbonImmutable::class => true,
        Carbon::class => true,
    ];

    public function __construct(array $defaultContext = [])
    {
        $this->setDefaultContext($defaultContext);
    }

    public function setDefaultContext(array $defaultContext): void
    {
        $this->defaultContext = array_merge($this->defaultContext, $defaultContext);
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            CarbonImmutable::class => true,
            Carbon::class => true,
        ];
    }

    /**
     * @throws InvalidArgumentException
     */
    public function normalize(mixed $object, ?string $format = null, array $context = []): int|float|string
    {
        if (!$object instanceof \DateTimeInterface) {
            throw new InvalidArgumentException('The object must implement the "\DateTimeInterface".');
        }

        $dateTimeFormat = $context[self::FORMAT_KEY] ?? $this->defaultContext[self::FORMAT_KEY];
        $timezone = $this->getTimezone($context);

        if (null !== $timezone) {
            $object = clone $object;
            $object = $object->setTimezone($timezone);
        }

        return match ($context[self::CAST_KEY] ?? $this->defaultContext[self::CAST_KEY] ?? false) {
            'int' => (int)$object->format($dateTimeFormat),
            'float' => (float)$object->format($dateTimeFormat),
            default => $object->format($dateTimeFormat),
        };
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof CarbonImmutable || $data instanceof Carbon;
    }

    /**
     * @throws NotNormalizableValueException
     */
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): CarbonImmutable|Carbon
    {
        $dateTimeFormat = $context[self::FORMAT_KEY] ?? null;
        $timezone = $this->getTimezone($context);

        if (null === $data || (\is_string($data) && '' === trim($data))) {
            throw NotNormalizableValueException::createForUnexpectedDataType('The data is either an empty string or null, you should pass a string that can be parsed with the passed format or a valid DateTime string.', $data, [Type::BUILTIN_TYPE_STRING], $context['deserialization_path'] ?? null, true);
        }

        if (null !== $dateTimeFormat) {
            $object = \DateTime::class === $type ? Carbon::createFromFormat($dateTimeFormat, $data, $timezone) : CarbonImmutable::createFromFormat($dateTimeFormat, $data, $timezone);

            if (false !== $object) {
                return $object;
            }

            $dateTimeErrors = \DateTime::class === $type ? \DateTime::getLastErrors() : \DateTimeImmutable::getLastErrors();

            throw NotNormalizableValueException::createForUnexpectedDataType(sprintf('Parsing datetime string "%s" using format "%s" resulted in %d errors: ', $data, $dateTimeFormat, $dateTimeErrors['error_count'])."\n".implode("\n", $this->formatDateTimeErrors($dateTimeErrors['errors'])), $data, [Type::BUILTIN_TYPE_STRING], $context['deserialization_path'] ?? null, true);
        }

        try {
            return \DateTime::class === $type ? new Carbon($data, $timezone) : new CarbonImmutable($data, $timezone);
        } catch (\Exception $e) {
            throw NotNormalizableValueException::createForUnexpectedDataType($e->getMessage(), $data, [Type::BUILTIN_TYPE_STRING], $context['deserialization_path'] ?? null, false, $e->getCode(), $e);
        }
    }

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return isset(self::SUPPORTED_TYPES[$type]);
    }

    /**
     * Formats datetime errors.
     *
     * @return string[]
     */
    private function formatDateTimeErrors(array $errors): array
    {
        $formattedErrors = [];

        foreach ($errors as $pos => $message) {
            $formattedErrors[] = sprintf('at position %d: %s', $pos, $message);
        }

        return $formattedErrors;
    }

    private function getTimezone(array $context): ?\DateTimeZone
    {
        $dateTimeZone = $context[self::TIMEZONE_KEY] ?? $this->defaultContext[self::TIMEZONE_KEY];

        if (null === $dateTimeZone) {
            return null;
        }

        return $dateTimeZone instanceof \DateTimeZone ? $dateTimeZone : new \DateTimeZone($dateTimeZone);
    }
}

