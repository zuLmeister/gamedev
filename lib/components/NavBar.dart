import 'package:flutter/material.dart';
import 'package:get/get.dart';

class Navbar extends StatelessWidget {
  const Navbar ({Key? key}) : super(key: key);
  
  @override
  Widget build(BuildContext context) {
    return Drawer(
      backgroundColor: const Color.fromARGB(255, 2,48,71),
      child: ListView(
        padding: EdgeInsets.zero,
        children: [
          UserAccountsDrawerHeader(
            accountName: const Text('Zulfikar Ahmad Komari', style: TextStyle(color: Color.fromARGB(255, 2,48,71)),),
            accountEmail: const Text('zulwasright@gmail.com', style: TextStyle(color: Color.fromARGB(255, 2,48,71))),
            currentAccountPicture: CircleAvatar(
              child: ClipOval(
                child: Image.network(
                    'https://oflutter.com/wp-content/uploads/2021/02/girl-profile.png',
                    width: 90.0,
                    height: 90.0,
                    fit: BoxFit.cover),
              ),
            ),
            decoration: const BoxDecoration(
              color: Colors.amber,
            ),
          ),
          ListTile(
            leading: const Icon(Icons.house_sharp,color: Colors.white),
            title: const Text('Home Page',style: TextStyle(color: Colors.white)),
            onTap: () {
              Get.toNamed('/homepage');
            },
          ),
          ListTile(
            leading: const Icon(Icons.account_circle, color: Colors.white),
            title: const Text('Edit Profil',style: TextStyle(color: Colors.white)),
            onTap: () {
              Get.toNamed('/editprofil');
            },
          ),
          ListTile(
            leading: const Icon(Icons.exit_to_app_sharp, color: Colors.white,),
            title: const Text('Logout',style: TextStyle(color: Colors.white)),
            onTap: () {
              Get.toNamed('/loginpage');
            },
          ),
        ],
      ),
    );
  }
}
