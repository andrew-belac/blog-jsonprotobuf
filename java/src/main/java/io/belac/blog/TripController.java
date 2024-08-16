package io.belac.blog;

import io.belac.blog.dtos.TripDto;
import jakarta.enterprise.context.ApplicationScoped;
import jakarta.inject.Inject;
import jakarta.json.bind.Jsonb;
import jakarta.ws.rs.Consumes;
import jakarta.ws.rs.POST;
import jakarta.ws.rs.Path;
import jakarta.ws.rs.Produces;
import jakarta.ws.rs.core.Response;

import java.time.OffsetDateTime;
import java.time.temporal.ChronoUnit;

@ApplicationScoped
@Path("/trip")
public class TripController {

    @Inject
    Jsonb jsonb;

    @Produces("text/plain")
    @Consumes("text/plain")
    @POST
    public Response readTrip(String tripString){
        var startedAt = OffsetDateTime.now();
        var dto = jsonb.fromJson(tripString, TripDto.class);
        return Response.ok(startedAt.until(OffsetDateTime.now(), ChronoUnit.MILLIS)).build();
    }
}
