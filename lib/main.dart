import 'package:flutter/material.dart';
import 'package:gamedev/login/login_page.dart';
import './pages/home_page.dart';
import './pages/explore_page.dart';
import './login/login_page.dart';
import './pages/detail_page.dart';
import 'package:flutter/services.dart';

void main() {
  WidgetsFlutterBinding.ensureInitialized();
  SystemChrome.setPreferredOrientations([DeviceOrientation.portraitUp]);
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({Key? key}) : super(key: key);
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
        debugShowCheckedModeBanner: false,
        home: const HomePage(),
        initialRoute: '/loginpage',
        routes: {
          '/homepage': (context) => const HomePage(),
          '/loginpage': (context) => const LoginPage(),
          '/explorepage': (context) => const ExplorePage(),
          '/detail-page' : (context) => const DetailPage(),
        });
  }
}
