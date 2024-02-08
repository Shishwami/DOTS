const _RESET_TIME = 1000;

const DOTS_DOCUMENT = {
    NAME: 'DOTS_DOCUMENT',
    DOC_NUM: 'DOC_NUM',
    LETTER_DATE: 'LETTER_DATE',
    DOC_OFFICE: 'DOC_OFFICE',
    DOC_TYPE: 'DOC_TYPE',
    DOC_SUBJECT: 'DOC_SUBJECT',
    RECEIVED_BY: 'RECEIVED_BY',
    DATE_TIME_RECEIVED: 'DATE_TIME_RECEIVED',
    DOC_STATUS: 'DOC_STATUS',
};

const DOTS_DOC_LOGS = {
    NAME: 'DOTS_DOC_LOGS',
    DOC_NUM: 'DOC_NUM',
    ID: 'ID',
    DOC_LOCATION: 'DOC_LOCATION',
    DOC_OPERATION: 'DOC_OPERATION',
    DOC_ADDRESSEE: 'DOC_ADDRESSEE',
    DOC_STATUS: 'DOC_STATUS',
};

const DOTS_DOC_OFFICE = {
    NAME: 'DOTS_DOC_OFFICE',
    ID: 'ID',
    DOC_OFFICE_NAME: 'DOC_OFFICE_NAME',
    DOC_OFFICE_CODE: 'DOC_OFFICE_CODE'
};

const DOTS_DOC_DIVISION = {
    NAME: 'DOTS_DOC_DIVISION',
    ID: 'ID',
    DOC_DIVISION_NAME: 'DOC_DIVISION_NAME',
    DOC_DIVISION_CODE: 'DOC_DIVISION_CODE'
};
const DOTS_DOC_TYPE = {
    NAME: 'DOTS_DOC_TYPE',
    ID: 'ID',
    DOC_TYPE_NAME: 'DOC_TYPE_NAME',
    DOC_TYPE_CODE: 'DOC_TYPE_CODE'
};

const DOTS_DOC_PRPS = {
    NAME: 'DOTS_DOC_PRPS',
    ID: 'ID',
    DOC_PRPS_NAME: 'DOC_PRPS_NAME',
    DOC_PRPS_CODE: 'DOC_PRPS_CODE'
};
const DOTS_DOC_STATUS = {

    NAME: 'DOTS_DOC_STATUS',
    ID: 'ID',
    DOC_STATUS_NAME: 'DOC_STATUS_NAME',
    DOC_STATUS_CODE: 'DOC_STATUS_CODE'
};
const DOTS_ACCOUNT_INFO = {
    NAME: 'DOTS_ACCOUNT_INFO',
    HRIS_ID: 'HRIS_ID',
    FULL_NAME: 'FULL_NAME',
    INITIAL: 'INITIAL',
    USERNAME: 'USERNAME',
    PASSWORD: 'PASSWORD',
    DIVISION: 'DIVISION',
}

const _REQUEST = {
    INSERT: 'INSERT',
    SELECT: 'SELECT',
    UPDATE: 'UPDATE',
    DELETE: 'DELETE',
    GET_DATE: 'GET_DATE',
    GET_DOC_NUM: 'GET_DOC_NUM',
    CREATE_SESSION: 'CREATE_SESSION',
    INSERT_DOCLOG: 'INSERT_DOCLOG',
    GET_SESSION_NAME: 'GET_SESSION_NAME',
    GET_SESSION_INITIAL: 'GET_SESSION_INITIAL',
    GET_SESSION_ID: 'GET_SESSION_ID',
}
const DOTS_OUTBOUND = {
    NAME: 'DOTS_OUTBOUND',
    DOC_NUM: 'DOC_NUM',
    ID: 'ID',
    DOC_PRPS: 'DOC_PRPS',
    DOC_ADDRESSEE: 'DOC_ADDRESSEE',
    DOC_NOTES: 'DOC_NOTES',
    DOC_ACTION: 'DOC_ACTION',
    DOC_LOCATION: 'DOC_LOCATION',
    DOC_DIVISION: 'DOC_DIVISION',
}

const _SUB_NAME = {

    ID: "ID",

    DOC_TYPE_NAME: 'Document Name',
    DOC_TYPE_CODE: 'Document Code',

    DOC_PRPS_NAME: 'Purpose Name',
    DOC_PRPS_CODE: 'Purpose Code',

    DOC_OFFICE_NAME: 'Office Name',
    DOC_OFFICE_CODE: 'Office Code',

    DOC_DIVISION_NAME: 'Division Name',
    DOC_DIVISION_CODE: 'Division Code',

    DOC_STATUS_NAME: 'Status',
    DOC_STATUS_CODE: 'Status Code',

    DOC_NUM: 'No.',
    DOC_SUBJECT: 'Subject',
    DOC_TYPE: 'Document Type',
    DOC_OFFICE: 'Document Office',
    LETTER_DATE: 'Letter Date',
    OFFICE_AGENCY: 'Office/Agency',
    RECEIVED_BY: 'Received By',
    DATE_TIME_RECEIVED: 'Date Received',
    DOC_STATUS: "Status",

    HRIS_ID: 'HRIS ID',
    FULL_NAME: 'Fullname',
    INITIAL: 'Initial',

    // DOC_PRPS: 'Purpose',
    // DOC_ADDRESSEE: 'Addressee',
    // DOC_NOTES: 'Notes',
    // DOC_ACTION: 'Action',
    // DOC_LOCATION: 'Location',
    // DOC_DIVISION: 'Division',
}
