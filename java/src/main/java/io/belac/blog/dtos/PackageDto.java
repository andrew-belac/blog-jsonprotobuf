package io.belac.blog.dtos;

public record PackageDto(
        String barcode,
        Double weight,
        Double volume,
        Double length,
        Double width,
        Double height
) {
}
