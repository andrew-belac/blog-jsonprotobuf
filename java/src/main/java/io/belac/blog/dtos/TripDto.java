package io.belac.blog.dtos;

import io.quarkus.runtime.annotations.RegisterForReflection;

import java.time.OffsetDateTime;
import java.util.List;

@RegisterForReflection
public record TripDto (
    OffsetDateTime createdAt,
    OffsetDateTime updatedAt,
    String id,
    String code,
    String externalId,
    String department,

    String driverName,
    String driverMobile,
    String vehicleRegistration,
    String vehicleType,
    OffsetDateTime plannedStartAt,
    OffsetDateTime plannedEndAt,
    OffsetDateTime actualStartedAt,
    OffsetDateTime actualEndedAt,
    TripStatusEnum status,
    List<TransportDto> transports


    ){}
