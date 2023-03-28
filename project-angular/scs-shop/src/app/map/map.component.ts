import { HttpErrorResponse } from '@angular/common/http';
import { Component, ViewChild } from '@angular/core';
import { GoogleMap, MapInfoWindow, MapMarker } from '@angular/google-maps';
import { GeocoderResponse } from '../models/geocoder-response.model';
import { GeocodingService } from '../geocoding.service';

@Component({
  selector: 'app-map',
  templateUrl: './map.component.html',
  styleUrls: ['./map.component.css'],
})
export class MapComponent {
  findAddress() {
    if (!this.address || this.address.length === 0) {
      return;
    }

    this.geocoderWorking = true;
    this.geocodingService
      .getLocation(this.address)
      .subscribe(
        (response: GeocoderResponse) => {
          if (response.status === 'OK' && response.results?.length) {
            const location = response.results[0];
            const loc: any = location.geometry.location;

            this.locationCoords = new google.maps.LatLng(loc.lat, loc.lng);

            this.mapCenter = location.geometry.location;

            setTimeout(() => {
              if (this.map !== undefined) {
                this.map.panTo(location.geometry.location);
              }
            }, 500);

            this.address = location.formatted_address;
            this.formattedAddress = location.formatted_address;
            this.markerInfoContent = location.formatted_address;

            this.markerOptions = {
              draggable: true,
              animation: google.maps.Animation.DROP,
            };
          } else {
          }
        },
        (err: HttpErrorResponse) => {
          console.error('geocoder error', err);
        }
      )
      .add(() => {
        this.geocoderWorking = false;
      });
  }
  getCurrentLocation() {
    this.geolocationWorking = true;
    navigator.geolocation.getCurrentPosition(
      (position) => {
        this.geolocationWorking = false;

        const point: google.maps.LatLngLiteral = {
          lat: position.coords.latitude,
          lng: position.coords.longitude,
        };

        this.geocoderWorking = true;
        this.geocodingService
          .geocodeLatLng(point)
          .then((response: GeocoderResponse) => {
            if (response.status === 'OK' && response.results?.length) {
              const value = response.results[0];

              this.locationCoords = new google.maps.LatLng(point);

              this.mapCenter = new google.maps.LatLng(point);
              this.map.panTo(point);

              this.address = value.formatted_address;
              this.formattedAddress = value.formatted_address;
              this.markerInfoContent = value.formatted_address;

              this.markerOptions = {
                draggable: true,
                animation: google.maps.Animation.DROP,
              };
            } else {

            }
          })
          .finally(() => {
            this.geocoderWorking = false;
          });
      },
      (error) => {
        this.geolocationWorking = false;

        if (error.PERMISSION_DENIED) {

        } else if (error.POSITION_UNAVAILABLE) {

        } else if (error.TIMEOUT) {

        } else {
        }
      },
      { enableHighAccuracy: true }
    );
  }
  onMapDragEnd(event: google.maps.KmlMouseEvent) {
    const point: google.maps.LatLngLiteral = {
      lat: event.latLng.lat(),
      lng: event.latLng.lng(),
    };

    this.geocoderWorking = true;
    this.geocodingService
      .geocodeLatLng(point)
      .then((response: GeocoderResponse) => {
        if (response.status === 'OK') {
          if (response.results.length) {
            const value = response.results[0];

            this.locationCoords = new google.maps.LatLng(point);

            this.mapCenter = new google.maps.LatLng(point);
            this.map.panTo(point);

            this.address = value.formatted_address;
            this.formattedAddress = value.formatted_address;

            this.markerOptions = {
              draggable: true,
              animation: google.maps.Animation.DROP,
            };

            this.markerInfoContent = value.formatted_address;
          }
        }
      })
      .finally(() => {
        this.geocoderWorking = false;
      });
  }
  constructor(private geocodingService: GeocodingService) {}

  @ViewChild(GoogleMap, { static: false }) map: GoogleMap;
  @ViewChild(MapInfoWindow, { static: false }) infoWindow: MapInfoWindow;
  
  mapZoom = 12;
  mapCenter: google.maps.LatLng;
  mapOptions: google.maps.MapOptions = {
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    zoomControl: true,
    scrollwheel: false,
    disableDoubleClickZoom: true,
    maxZoom: 20,
    minZoom: 4,
  };

  markerInfoContent = '';
  markerOptions: google.maps.MarkerOptions = {
    draggable: false,
    animation: google.maps.Animation.DROP,
  };

  geocoderWorking = false;
  geolocationWorking = false;

  address: string;
  formattedAddress?: string | null = null;
  locationCoords?: google.maps.LatLng | null = null;

  get isWorking(): boolean {
    return this.geolocationWorking || this.geocoderWorking;
  }

  openInfoWindow(marker: MapMarker) {
    this.infoWindow.open(marker);
  }
}
