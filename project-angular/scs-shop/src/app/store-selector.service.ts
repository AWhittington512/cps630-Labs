import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class StoreSelectorService {

  constructor() { }

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

  getLocation() {
    if (window.localStorage.getItem("location")) {
      return window.localStorage.getItem("location")
    }

    return null;
  }
}
