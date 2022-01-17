import { Component, OnInit } from '@angular/core';

import { LoadingController, NavController } from '@ionic/angular';
import { AuthServiceService } from './../../app/auth-service.service';
import { AlertController } from '@ionic/angular';
import { FormControl, FormGroupDirective, FormBuilder, FormGroup, NgForm, Validators } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';


@Component({
  selector: 'app-form-edit',
  templateUrl: './form-edit.page.html',
  styleUrls: ['./form-edit.page.scss'],
})
export class FormEditPage implements OnInit {

  public FormEditData: FormGroup;
  ResponseData: any;
  dataBarangEdit: any;

  constructor(public navCtrl: NavController,
    public api: AuthServiceService,
    public loadingController: LoadingController,
    public alertController: AlertController,
    private formBuilder: FormBuilder,
    private activatedRoute: ActivatedRoute) {
    this.FormEditData = this.formBuilder.group({
      id_barang: [this.activatedRoute.snapshot.paramMap.get('id')],
      nama_barang: [null, Validators.required],
      qty: [null, Validators.required],
      harga: [null, Validators.required]
    });
  }

  ngOnInit() {
    this.DataBarangEdit();
  }
  DataBarangEdit() {
    const idbarangEdit = {
      id_barang: this.activatedRoute.snapshot.paramMap.get('id')
    };
    this.api.Post_Data('Get_Barang_Edit', idbarangEdit)
      .subscribe(res => {
        this.ResponseData = res;
        if (this.ResponseData.Get_Barang_Edit) {
          this.dataBarangEdit = this.ResponseData.Get_Barang_Edit;
          this.FormEditData.controls.nama_barang.setValue(this.dataBarangEdit[0].nama_barang);
          this.FormEditData.controls.qty.setValue(this.dataBarangEdit[0].qty);
          this.FormEditData.controls.harga.setValue(this.dataBarangEdit[0].harga);
        }
        else {
          this.dataBarangEdit = '';
        }
      }, err => {
        console.log(err);
      });
  }

  simpan() {
    this.api.Post_Data('Edit_Barang', this.FormEditData.value)
      .subscribe(res => {
        this.navCtrl.navigateBack('/home');
      }, (err) => {
        console.log(err);
      });
  }

}
