package io.belac.blog.dtos;

import java.time.OffsetDateTime;
import java.util.List;

public record TransportDto(
        String id,
        String code,
        String externalId,
        OffsetDateTime plannedStartAt,
        OffsetDateTime plannedEndAt,
        OffsetDateTime actualStartedAt,
        OffsetDateTime actualEndedAt,
        Double cost,
        Double travelTime,
        List<PackageDto> packages
) {
}
