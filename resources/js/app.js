import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import {
    Collapse,
    Ripple,
    // FORMS
    Input,
    Dropdown,
    Select,
    Modal,
    Alert,
    initTE,
  } from "tw-elements";
  
  initTE({ 
    Collapse, 
    Ripple, 
    Dropdown, 
    Input, 
    Select, 
    Modal, 
    Alert, 
  });