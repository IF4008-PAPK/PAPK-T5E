import { Component } from '@angular/core';
// manambahkan
import { LoadingController } from '@ionic/angular';
import { AuthServiceService } from './../../app/auth-service.service';
import { AlertController } from '@ionic/angular';
import { NgZone } from '@angular/core';


@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
})
export class HomePage {
  ResponseData:any;
  Data_Barang:any;
  constructor(public api: AuthServiceService, public loadingController: LoadingController,
  public alertController: AlertController, private zone:NgZone) { }
  
  ionViewWillEnter(){
    this.DataBarang();
  }

  async DataBarang() {   
    const loading = await this.loadingController.create({
      message: 'Loading...'
    });
    await loading.present();  
    await this.api.Get_Data('Data_Barang')
      .subscribe(res => {
        this.ResponseData=res;
        if(this.ResponseData.Data_Barang){
          this.Data_Barang=this.ResponseData.Data_Barang;
          loading.dismiss();
        }
        else{ 
          this.Data_Barang='';
          loading.dismiss();
       }         
      }, err => {
        console.log(err);
        loading.dismiss();
      });
  }

  async presentAlertConfirm(idbarang) {
    const alert = await this.alertController.create({
      header: 'Konfirmasi',
      message: 'Apakah anda yakin akan menghapus data ini?',
      buttons: [
        {
          text: 'Tidak',
          role: 'cancel',
          cssClass: 'secondary',
          handler: (blah) => {
          }
        }, {
          text: 'Ya',
          handler: () => {
            this.HapusData(idbarang);
          }
        }
      ]
    });
    await alert.present();
  }

 HapusData(idbarang) {
    const idbarangDelete={
      id_barang:idbarang
    };
   this.api.Post_Data('Delete_Barang',idbarangDelete)
    .subscribe(res => {
      this.zone.run(() => {
        this.DataBarang();
      });        
      }, (err) => {
        console.log(err);
      });
  }


}
