package io.belac.blog;

import com.google.protobuf.InvalidProtocolBufferException;
import com.google.protobuf.Timestamp;
import io.belac.blog.dtos.*;
import jakarta.inject.Inject;
import jakarta.json.bind.Jsonb;
import jakarta.ws.rs.GET;
import jakarta.ws.rs.Path;
import jakarta.ws.rs.PathParam;
import jakarta.ws.rs.Produces;
import jakarta.ws.rs.core.MediaType;

import java.time.OffsetDateTime;
import java.time.temporal.ChronoUnit;
import java.util.ArrayList;
import java.util.List;
import java.util.Random;
import java.util.UUID;


@Path("/benchmark")
public class BenchmarkController {

    @Inject
    Jsonb jsonb;

    Random random = new Random();

    @GET
    @Path("/json/{size}/{iters}")
    @Produces(MediaType.TEXT_PLAIN)
    public String benchmarkJson(@PathParam("size") Integer size, @PathParam("iters") Integer iters) {
        long serializationTime = 0;
        long deSerializationTime = 0;
        for (var i =0; i < iters; i++){
            var result = runSerialization(createTrip(size));
            serializationTime += result.duration();
            deSerializationTime += runDeSerialization(result.json());
        }

        return "serialize time " + serializationTime + " deserialize time " + deSerializationTime;
    }

    @GET
    @Path("/proto/{size}/{iters}")
    @Produces(MediaType.TEXT_PLAIN)
    public String benchmarkProto(@PathParam("size") Integer size, @PathParam("iters") Integer iters) throws InvalidProtocolBufferException {
        long serializationTime = 0;
        long deSerializationTime = 0;
        for (var i =0; i < iters; i++){
            var result = runProtoSerialization(createProtoTrip(createTrip(size)));
            serializationTime += result.duration();
            deSerializationTime += runProtoDeSerialization(result.bytes());
        }

        return "serialize time " + serializationTime + " derialize time " + deSerializationTime;
    }


    private TripSerializationResultRecord runSerialization(TripDto tripDto){
        var start = OffsetDateTime.now();
        var tripJson = jsonb.toJson(tripDto);
        return new TripSerializationResultRecord(tripJson, start.until(OffsetDateTime.now(), java.time.temporal.ChronoUnit.MICROS));
    }

    private long runDeSerialization(String tripString){
        var start = OffsetDateTime.now();
        jsonb.fromJson(tripString, TripDto.class);
        return start.until(OffsetDateTime.now(), java.time.temporal.ChronoUnit.MICROS);
    }

    private TripProtoSerializationResultRecord runProtoSerialization(Trip trip){
        var start = OffsetDateTime.now();
        return new TripProtoSerializationResultRecord(trip.toByteArray(), start.until(OffsetDateTime.now(), java.time.temporal.ChronoUnit.MICROS));
    }

    private long runProtoDeSerialization(byte[] tripBytes) throws InvalidProtocolBufferException {
        var start = OffsetDateTime.now();
        Trip.parseFrom(tripBytes);
        return start.until(OffsetDateTime.now(), ChronoUnit.MICROS);
    }

    private TripDto createTrip(Integer size) {
        return new TripDto(
                OffsetDateTime.now(),
                OffsetDateTime.now(),
                UUID.randomUUID().toString(),
                randomString(8),
                randomString(4),
                randomString(8),
                randomString(10),
                randomString(10),
                randomString(7),
                randomString(6),
                OffsetDateTime.now(),
                OffsetDateTime.now(),
                OffsetDateTime.now(),
                OffsetDateTime.now(),
                getRandomStatus(),
                createTransports(size)
        );
    }

    private Trip createProtoTrip(TripDto tripDto) {
        return Trip.newBuilder()
                .setCreatedAt(timestampFromOffsetDateTime(tripDto.createdAt()))
                .setUpdatedAt(timestampFromOffsetDateTime(tripDto.updatedAt()))
                .setActualEndAt(timestampFromOffsetDateTime(tripDto.actualEndedAt()))
                .setCode(tripDto.code())
                .setActualStartAt(timestampFromOffsetDateTime(tripDto.actualStartedAt()))
                .setDepartment(tripDto.department())
                .setDriverMobile(tripDto.driverMobile())
                .setDriverName(tripDto.driverName())
                .setExternalId(tripDto.externalId())
                .setId(tripDto.externalId())
                .setPlannedEndAt(timestampFromOffsetDateTime(tripDto.plannedEndAt()))
                .setPlannedStartAt(timestampFromOffsetDateTime(tripDto.plannedStartAt()))
                .setStatus(TripStatus.valueOf(tripDto.status().name()))
                .setVehicleRegistration(tripDto.vehicleRegistration())
                .setVehicleType(tripDto.vehicleType())
                .addAllTransports(transportsFromDto(tripDto.transports()))
                .build();
    }


    public List<Transport> transportsFromDto(List<TransportDto> transports){
        List<Transport> out = new ArrayList<>();
        for (TransportDto t: transports){
            out.add(transportFromTransportDto(t));
        }
        return out;
    }

    public Transport transportFromTransportDto(TransportDto transportDto){
        return Transport.newBuilder()
                .setActualEndAt(timestampFromOffsetDateTime(transportDto.actualStartedAt()))
                .setCode(transportDto.code())
                .setExternalId(transportDto.externalId())
                .setCost(transportDto.cost())
                .setId(transportDto.id())
                .setPlannedEndAt(timestampFromOffsetDateTime(transportDto.plannedEndAt()))
                .setTravelTime(transportDto.travelTime())
                .setActualStartAt(timestampFromOffsetDateTime(transportDto.actualStartedAt()))
                .setPlannedStartAt(timestampFromOffsetDateTime(transportDto.plannedStartAt()))
                .addAllPackages(packagesFromDto(transportDto.packages()))
                .build();
    }

    public List<Package> packagesFromDto(List<PackageDto> packages){
        List<Package> out = new ArrayList<>();
        for(PackageDto p : packages){
            out.add(packageFromDto(p));
        }
        return out;
    }


    public Package packageFromDto(PackageDto dto){
        return Package.newBuilder()
                .setBarcode(dto.barcode())
                .setHeight(dto.height())
                .setLength(dto.length())
                .setVolume(dto.volume())
                .setWeight(dto.weight())
                .setWidth(dto.weight())
                .build();
    }


    private Timestamp timestampFromOffsetDateTime(OffsetDateTime dt){
        return Timestamp.newBuilder()
                .setSeconds(dt.toEpochSecond())
                .setNanos(dt.getNano())
                .build();
    }


    private TransportDto createTransportDto(){
        return new TransportDto(
                randomString(16),
                randomString(16),
                randomString(32),
                OffsetDateTime.now(),
                OffsetDateTime.now(),
                OffsetDateTime.now(),
                OffsetDateTime.now(),
                Integer.valueOf(random.nextInt(1, 10000000)).doubleValue(),
                Integer.valueOf(random.nextInt(1, 1000)).doubleValue(),
                createPackages(10)
        );
    }

    private List<TransportDto> createTransports(Integer size){
        var out = new ArrayList<TransportDto>();
        for (var i = 0; i < size; i++){
            out.add(createTransportDto());
        }
        return out;
    }

    private PackageDto createPackage(){
        return new PackageDto(
                randomString(8),
                Integer.valueOf(random.nextInt(1, 10000)).doubleValue(),
                Integer.valueOf(random.nextInt(1, 10000)).doubleValue(),
                Integer.valueOf(random.nextInt(1, 10000)).doubleValue(),
                Integer.valueOf(random.nextInt(1, 100000)).doubleValue(),
                Integer.valueOf(random.nextInt(1, 100000)).doubleValue()
        );
    }

    private List<PackageDto> createPackages(Integer size){
        var out = new ArrayList<PackageDto>();
        for (var i = 0; i < size; i++){
            out.add(createPackage());
        }
        return out;
    }

    private TripStatusEnum getRandomStatus(){
        var statuses = TripStatus.values();
        return TripStatusEnum.values()[random.nextInt(0, 5)];
    }

    private String randomString(Integer length) {
        int leftLimit = 97; // letter 'a'
        int rightLimit = 122; // letter 'z'

        return random.ints(leftLimit, rightLimit + 1)
                .limit(length)
                .collect(StringBuilder::new, StringBuilder::appendCodePoint, StringBuilder::append)
                .toString();
    }
}
