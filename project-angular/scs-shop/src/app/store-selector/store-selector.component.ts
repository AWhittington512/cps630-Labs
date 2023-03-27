import { Component } from '@angular/core';

import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { GeocodingService } from '../geocoding.service';

@Component({
  selector: 'app-store-selector',
  templateUrl: './store-selector.component.html',
  styleUrls: ['./store-selector.component.css']
})
export class StoreSelectorComponent {

  constructor(private geocodingService: GeocodingService) { }

  getLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition((position) => {
        const pos: google.maps.LatLngLiteral = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };

        this.geocodingService.geocodeLatLng(pos).then((response) => {
          var city = response.results[0].address_components[2].long_name;
          var postal = response.results[0].address_components[6].long_name;
          console.log(city, postal);

          this.findStores(city, postal);
        })
      });
    } else {
      alert("Geolocation is not supported by this browser");
    }
  }

  findStores(city: string, postcode: string) {
    document.getElementById('postalCode').innerHTML = postcode
    switch (city) {
      case 'Toronto':
        document.getElementById('storeLocation').innerHTML = "Queen St W, Toronto"
        this.setLocation("Queen St W, Toronto")
        break
      case 'Markham':
        document.getElementById('storeLocation').innerHTML = "CF Markville, Markham"
        this.setLocation("CF Markville, Markham")
        break
      case 'Mississauga':
        document.getElementById('storeLocation').innerHTML = "Square One Shopping Centre, Mississauga"
        this.setLocation("Square One Shopping Centre, Mississauga")
        break
      default:
        document.getElementById('storeLocation').innerHTML = "No store selected"
    }
  }

  selectStore() {
    const selectButtons = document.querySelectorAll('.store');

    selectButtons.forEach(button => {
      button.addEventListener('click', () => {
        const storeName = button.closest('.store').querySelector('.store-name').textContent;
        this.setLocation(storeName);
        document.getElementById('storeLocation').innerHTML = storeName;
      });
    });
  }
  
  setLocation(value: string) {
    if (typeof(Storage) != "undefined") {
      localStorage.setItem("location", value)
    } else {
      console.log("Local storage unavailable")
    }
  }
  
  getLocationOnLoad() {
    if (window.localStorage.getItem("location")) {
      document.getElementById("storeLocation").innerHTML = window.localStorage.getItem("location")
    }
  }

  ngOnInit() {
    this.getLocationOnLoad()
  }
}
