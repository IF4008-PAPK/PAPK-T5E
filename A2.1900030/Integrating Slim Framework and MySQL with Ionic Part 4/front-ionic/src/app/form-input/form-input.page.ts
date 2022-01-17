import { Component, OnInit } from '@angular/core';
import { LoadingController, NavController } from '@ionic/angular';
import { AuthServiceService } from './../../app/auth-service.service';
import { AlertController } from '@ionic/angular';
import {
  FormControl,
  FormGroupDirective,
  FormBuilder,
  NgForm,
  Validators,
  FormGroup,
} from '@angular/forms'
import { Alert } from 'selenium-webdriver';




@Component({
  selector: 'app-form-input',
  templateUrl: './form-input.page.html',
  styleUrls: ['./form-input.page.scss'],
})
export class FormInputPage implements OnInit {
  public FormsSimpanData: FormGroup;
  FormSimpanData: FormGroup;

  constructor(
    public navCtrl: NavController,
    public api: AuthServiceService,
    public loadingController: LoadingController,
    public AlertController: AlertController,
    private formBuilder: FormBuilder
  ) {
    this.FormSimpanData = this.formBuilder.group({
      nama_barang: ['', Validators.required],
      qty: ['', Validators.required],
      harga: ['', Validators.required],
    });
  }

  ngOnInit() { }
  // Fungsi untuk Simpan Data.
  simpan() {
    this.api.Post_Data('Input_Barang', this.FormsSimpanData.value).subscribe(
      (res) => (
        this.navCtrl.navigateBack('/home')
      ),
      (err) => {
        console.log(err);
      }
    );
  }
  }