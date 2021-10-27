export const users = [
  {
    id: 1,
    name: 'user test 1',
  },
  {
    id: 2,
    name: 'user test 2',
  },
];

export const propertyTypes = [
  {
    id: 1,
    name: 'home',
  },
  {
    id: 2,
    name: 'garage',
  },
  {
    id: 3,
    name: 'office',
  },
];

export const properties = [
  {
    id: 1,
    userId: 1,
    typeId: 1,
    name: 'casa 1',
    rentedFrom: new Date(2020, 1, 22),
    rentedTo: new Date(2020, 7, 7),
  },
  {
    id: 2,
    userId: 2,
    typeId: 1,
    name: 'casa 2',
    rentedFrom: null,
    rentedTo: null
  },
  {
    id: 3,
    userId: 1,
    typeId: 2,
    name: 'garage 1',
    rentedFrom: new Date(2020, 3, 9),
    rentedTo: new Date(2020, 4, 7),
  },
  {
    id: 7,
    userId: 2,
    typeId: 2,
    name: 'garage 2',
    rentedFrom: new Date(2021, 4, 21),
    rentedTo: null,
  },
  {
    id: 4,
    userId: 1,
    typeId: 3,
    name: 'office 1',
    rentedFrom: new Date(2020, 5, 22),
    rentedTo: null,
  },
  {
    id: 5,
    userId: 1,
    typeId: 3,
    name: 'office 2',
    rentedFrom: null,
    rentedTo: null,
  },
  {
    id: 6,
    userId: 2,
    typeId: 3,
    name: 'office 3',
    rentedFrom: new Date(2021, 2, 2),
    rentedTo: null,
  },
];
