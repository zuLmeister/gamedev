import 'package:flutter/material.dart';
import 'package:gamedev/widgets/email_widget.dart';
import 'package:gamedev/widgets/password_widget.dart';
import 'package:gamedev/utils/services/local_storage_service.dart';
import 'package:gamedev/utils/services/rest_api.dart';
import '../../../../common/button_widget.dart';
import '../../../pdw.dart';

class LoginForm extends StatefulWidget {
  const LoginForm({Key? key}) : super(key: key);

  @override
  State<LoginForm> createState() => _LoginFormState();
}

class _LoginFormState extends State<LoginForm> {
  final _formKey = GlobalKey<FormState>();
  bool _isLoading = false;
  final _email = TextEditingController();
  final _password = TextEditingController();

  @override
  Widget build(BuildContext context) {
    return Form(
      key: _formKey,
      child: Center(
        child: SingleChildScrollView(
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              Text(
                "Login".toUpperCase(),
                style: const TextStyle(
                    height: 5,
                    fontFamily: 'RobotoMono',
                    color: Color.fromARGB(255, 252, 252, 252),
                    fontWeight: FontWeight.w900),
              ),
              EmailWidget(_email),
              PasswordWidget(_password),
              InkWell(
                onTap: () {
                  Navigator.pushNamed(context, '/pswd');
                },
                child: const Text(
                  "Lupa Password",
                  style: TextStyle(
                    color: Colors.amber,
                    fontWeight: FontWeight.bold,
                    decoration: TextDecoration.underline,
                  ),
                ),
              ),
              const SizedBox(
                height: 18,
              ),
              loginButton(),
              registerButton(),
              if (_isLoading)
                Center(
                  child: Container(
                    margin: const EdgeInsets.only(top: 16),
                    child: const CircularProgressIndicator(),
                  ),
                ),
              const SizedBox(height: defaultPadding),
            ],
          ),
        ),
      ),
    );
  }

  Widget loginButton() => Builder(
        builder: (context) => ButtonWidget("Masuk", 0, () {
          FocusScope.of(context).unfocus();
          var isValid = _formKey.currentState!.validate();
          checkLoginStatus(context, isValid);
        }),
      );

  Widget registerButton() => Builder(
        builder: (context) => Container(
          height: 55,
          width: double.infinity,
          margin: const EdgeInsets.symmetric(
            horizontal: 14,
            vertical: 14,
          ),
          child: OutlinedButton(
            style: OutlinedButton.styleFrom(
              side: const BorderSide(color: Colors.indigo),
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(8),
              ),
            ),
            onPressed: () => navigateToRegister(context),
            child: const Text(
              "Register",
              style: TextStyle(
                fontWeight: FontWeight.bold,
                fontSize: 15,
              ),
            ),
          ),
        ),
      );

  checkLoginStatus(BuildContext context, bool isValid) {
    if (isValid) {
      setState(() => _isLoading = true);
      RestApiService.login(_email.text, _password.text).then((value) {
        if (value.token!.isNotEmpty) {
          setLoginState();
          navigateToHomeScreen(context);
        } else {
          ScaffoldMessenger.of(context).showSnackBar(SnackBar(
            content: Text(
              value.error ?? "Credentials Wrong",
              style: const TextStyle(fontSize: 20),
            ),
            backgroundColor: Colors.red,
          ));
        }
        setState(() => _isLoading = false);
      });
    }
  }

  void navigateToHomeScreen(BuildContext context) {
    Navigator.popAndPushNamed(context, '/homepage');
  }

  void navigateToRegister(BuildContext context) {
    Navigator.pushNamed(context, '/signup');
  }

  Future setLoginState() async {
    LocalStorageService.setStateLogin(true);
  }
}
