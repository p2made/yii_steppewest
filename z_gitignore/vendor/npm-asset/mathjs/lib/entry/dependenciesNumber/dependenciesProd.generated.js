"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.prodDependencies = void 0;

var _dependenciesMultiply = require("./dependenciesMultiply.generated");

var _dependenciesTyped = require("./dependenciesTyped.generated");

var _factoriesNumber = require("../../factoriesNumber.js");

/**
 * THIS FILE IS AUTO-GENERATED
 * DON'T MAKE CHANGES HERE
 */
var prodDependencies = {
  multiplyDependencies: _dependenciesMultiply.multiplyDependencies,
  typedDependencies: _dependenciesTyped.typedDependencies,
  createProd: _factoriesNumber.createProd
};
exports.prodDependencies = prodDependencies;