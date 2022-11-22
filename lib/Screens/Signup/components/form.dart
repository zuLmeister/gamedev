import 'package:flutter/material.dart';

import 'package:gamedev/widgets/email_widget.dart';
import 'package:gamedev/widgets/password_widget.dart';
import 'package:gamedev/widgets/button_widget.dart';

import 'package:gamedev/utils/services/rest_api.dart';

class SignUpForm extends StatefulWidget {
  const SignUpForm({Key? key}) : super(key: key);

  @override
  State<SignUpForm> createState() => _SignUpFormState();
}

class _SignUpFormState extends State<SignUpForm> {
  final _formKey = GlobalKey<FormState>();
  final _email = TextEditingController();
  final _password = TextEditingController();
  bool _isLoading = false;

  @override
  Widget build(BuildContext context) {
    return Form(
      key: _formKey,
      child: Column(
        children: [
          Text(
            "Sign Up".toUpperCase(),
            style: const TextStyle(
                height: 5,
                fontFamily: 'RobotoMono',
                color: Color.fromARGB(255, 252, 252, 252),
                fontWeight: FontWeight.w900),
          ),
          EmailWidget(_email),
          PasswordWidget(_password),
          ButtonWidget(
            "Register",
            24,
            () {
              FocusScope.of(context).unfocus();
              var isValid = _formKey.currentState!.validate();
              checkRegisterStatus(context, isValid);
            },
          ),
          if (_isLoading)
            Center(
              child: Container(
                margin: const EdgeInsets.only(top: 16),
                child: const CircularProgressIndicator(),
              ),
            ),
        ],
      ),
    );
  }

  void checkRegisterStatus(BuildContext context, bool isValid) {
    if (isValid) {
      setState(() => _isLoading = true);
      RestApiService.register(_email.text, _password.text).then((value) {
        if (value.token!.isNotEmpty) {
          _navigateToLoginScreen();
        } else {
          ScaffoldMessenger.of(context).showSnackBar(SnackBar(
            content: Text(
              value.error ?? "Something Went Wrong",
              style: const TextStyle(fontSize: 20),
            ),
            backgroundColor: Colors.red,
          ));
        }
        setState(() => _isLoading = false);
      });
    }
  }

  void _navigateToLoginScreen() {
    Navigator.pop(context);
  }
}
