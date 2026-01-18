variable "resource_group_name" {
  default = "myResourceGroup"
}

variable "location" {
  default = "canadacentral"
}

variable "cluster_name" {
  default = "myAKSCluster"
}

variable "dns_prefix" {
  default = "myaks"
}

variable "node_count" {
  default = 1
}

variable "acr_name" {
  default = "myInternalDevPlatformACR"
}

variable "subscription_id" {
  description = "The Azure Subscription ID"
  type        = string
}
